<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'model_type',
        'model_id',
        'colour',
        'route',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
