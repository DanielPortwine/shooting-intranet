<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        'description',
        'level',
        'threshold',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'parent_id' => 'integer',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('created_at');
    }

    public function parent()
    {
        return $this->belongsTo(Award::class, 'parent_id');
    }

    public function levels()
    {
        return $this->hasMany(Award::class, 'parent_id');
    }
}
