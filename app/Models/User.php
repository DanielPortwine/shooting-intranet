<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'forenames',
        'email',
        'password',
        'home_phone',
        'mobile_phone',
        'address',
        'previous_address',
        'date_of_birth',
        'occupation',
        'nationality',
        'convictions',
        'clubs',
        'primary_club',
        'membership_refused',
        'qualifications',
        'experience',
        'fac_number',
        'fac_force',
        'fac_expiry',
        'sgc_number',
        'sgc_force',
        'sgc_expiry',
        'certificate_refused',
        'certificate_prevented',
        'identification_1',
        'identification_2',
        'members_known_to',
        'member_sponsor',
        'reference',
        'section_21',
        'signature',
        'approved',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function canAccessFilament(): bool
    {
        return
            $this->can('access-admin') &&
            $this->hasVerifiedEmail();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return Storage::url($this->profile_photo_path);
    }
}
