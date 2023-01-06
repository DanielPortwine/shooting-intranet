<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Stage extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'competition_id',
        'title',
        'description',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function targets()
    {
        return $this->hasMany(Target::class);
    }

    public function scores()
    {
        return $this->hasManyThrough(TargetScore::class, Target::class);
    }

    public function shooters()
    {
        return $this->belongsToMany(User::class)->withPivot(['time', 'points', 'penalties', 'score']);
    }

    public function completed(): bool
    {
        if ($this->targets->count() === 0) {
            return false;
        }

        foreach ($this->targets as $target) {
            if (count($target->scores) === 0) {
                return false;
            }
        }

        foreach ($this->competition->shooters as $shooter) {
            if (empty($shooter->stages->where('id', $this->id)->first())) {
                return false;
            }
        }

        return true;
    }

    public function started(): bool
    {
        if ($this->targets->count() === 0) {
            return false;
        }

        foreach ($this->targets as $target) {
            if (count($target->scores) > 0) {
                return true;
            }
        }

        foreach ($this->competition->shooters as $shooter) {
            if (!empty($shooter->stages->where('id', $this->id)->first())) {
                return true;
            }
        }

        return false;
    }
}
