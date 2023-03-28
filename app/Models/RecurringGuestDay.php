<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringGuestDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'day',
        'week',
    ];

    public function days()
    {
        return $this->hasMany(GuestDay::class);
    }
}
