<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    public function scores()
    {
        return $this->hasMany(TargetTypeScore::class);
    }

    public function targets()
    {
        return $this->hasMany(Target::class);
    }

    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }
}
