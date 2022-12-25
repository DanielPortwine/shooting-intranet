<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetTypeScore extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'target_type_id',
        'score',
    ];

    public function type()
    {
        return $this->belongsTo(TargetType::class);
    }
}
