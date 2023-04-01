<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firearm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'make',
        'model',
        'fac_number',
        'serial',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkIns()
    {
        return $this->belongsToMany(CheckIn::class);
    }

    public function targets()
    {
        return $this->hasMany(Target::class);
    }
}
