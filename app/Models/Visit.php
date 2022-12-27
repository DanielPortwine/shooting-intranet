<?php

namespace App\Models;

use App\Models\Scopes\PrivateScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Visit extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'check_in_id',
        'description',
        'private',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PrivateScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkIn()
    {
        return $this->belongsTo(CheckIn::class);
    }

    public function targets()
    {
        return $this->hasMany(Target::class);
    }
}
