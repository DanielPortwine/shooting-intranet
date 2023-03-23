<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'price',
        'recurring',
        'recurring_start_date',
        'pro_rata',
        'charge_full_first',
    ];

    protected $casts = [
        'recurring_start_date' => 'datetime',
    ];

    public function scopeNotExcluded(Builder $query, $userPackages): void
    {
        $query->whereDoesntHave('excludedPackages', function ($query) use ($userPackages) {
            $query->whereIn('id', $userPackages);
        });
    }

    public function scopeNotRequired(Builder $query, $userPackages): void
    {
        $query->where(function ($query) use ($userPackages) {
            $query->whereDoesntHave('requiredPackages')
                ->orWhereHas('requiredPackages', function ($query) use ($userPackages) {
                    $query->whereIn('id', $userPackages);
                });
        });
    }

    public function scopeNotDiscount(Builder $query): void
    {
        $query->where('price', '>=', 0);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function excludedPackages()
    {
        return $this->belongsToMany(Package::class, 'package_restrictions', 'package_id', 'related_package_id')
            ->withPivot('type')
            ->wherePivot('type', 'excluded');
    }

    public function requiredPackages()
    {
        return $this->belongsToMany(Package::class, 'package_restrictions', 'package_id', 'related_package_id')
            ->withPivot('type')
            ->wherePivot('type', 'required');
    }

    public function requiredByPackages()
    {
        return $this->belongsToMany(Package::class, 'package_restrictions', 'related_package_id', 'package_id')
            ->withPivot('type')
            ->wherePivot('type', 'required');
    }
}
