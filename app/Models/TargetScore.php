<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetScore extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'target_id',
        'score_id',
    ];

    public function target()
    {
        return $this->belongsTo(Target::class);
    }

    public function score()
    {
        return $this->belongsTo(TargetTypeScore::class);
    }
}
