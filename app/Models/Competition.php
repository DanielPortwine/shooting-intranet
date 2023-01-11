<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Competition extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'date',
        'target_type_id',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function targetType()
    {
        return $this->belongsTo(TargetType::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function targets()
    {
        return $this->hasManyThrough(Target::class, Stage::class);
    }

    public function shooters()
    {
        return $this->belongsToMany(User::class);
    }

    public function calendarItem()
    {
        return $this->morphOne(CalendarItem::class, 'model');
    }

    public function hasShooter(User $shooter)
    {
        return $this->shooters()->where('users.id', $shooter->id)->exists();
    }

    public function completed(): bool
    {
        if ($this->stages->count() === 0) {
            return false;
        }

        foreach ($this->stages as $stage) {
            if (!$stage->completed()) {
                return false;
            }
        }

        return true;
    }
}
