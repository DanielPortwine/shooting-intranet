<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'status',
        'recurring_guest_day_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function calendarItem()
    {
        return $this->morphOne(CalendarItem::class, 'model');
    }

    public function guests()
    {
        return $this->belongsToMany(User::class);
    }

    public function recurringDay()
    {
        return $this->belongsTo(RecurringGuestDay::class);
    }
}
