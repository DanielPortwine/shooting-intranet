<?php

namespace App\Models;

use App\Observers\PaymentObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'package_id',
        'price',
        'payment_method',
        'due_date',
        'reminder_date',
        'paid',
        'paid_at',
    ];

    protected $casts = [
        'due_date' => 'date',
        'reminder_date' => 'date',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paid()
    {
        $this->paid = true;
        $this->paid_at = now();
    }
}
