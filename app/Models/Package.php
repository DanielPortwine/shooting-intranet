<?php

namespace App\Models;

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

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
