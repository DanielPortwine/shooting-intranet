<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserApplicationUpdate extends Component
{
    public User $user;

    public $surname;
    public $forenames;
    public $home_phone;
    public $mobile_phone;
    public $address;
    public $previous_address;
    public $date_of_birth;
    public $occupation;
    public $nationality;
    public $convictions;
    public $clubs;
    public $primary_club;
    public $membership_refused;
    public $qualifications;
    public $experience;
    public $fac_number;
    public $fac_force;
    public $fac_expiry;
    public $sgc_number;
    public $sgc_force;
    public $sgc_expiry;
    public $certificate_refused;
    public $certificate_prevented;
    public $show = true;

    protected $rules = [
        'surname' => ['required', 'string', 'max:25'],
        'forenames' => ['required', 'string', 'max:255'],
        'home_phone' => ['required', 'string', 'max:14'],
        'mobile_phone' => ['required', 'string', 'max:14'],
        'address' => ['required', 'string', 'max:255'],
        'previous_address' => ['required', 'string', 'max:255'],
        'date_of_birth' => ['required', 'date'],
        'occupation' => ['required', 'string', 'max:255'],
        'nationality' => ['required', 'string', 'max:25'],
        'convictions' => ['required', 'string', 'max:255'],
        'clubs' => ['required', 'string', 'max:255'],
        'primary_club' => ['required', 'string', 'max:255'],
        'membership_refused' => ['required', 'string', 'max:255'],
        'qualifications' => ['required', 'string', 'max:255'],
        'experience' => ['required', 'string', 'max:255'],
        'fac_number' => ['required', 'string', 'max:255'],
        'fac_force' => ['required', 'string', 'max:255'],
        'fac_expiry' => ['nullable', 'date'],
        'sgc_number' => ['required', 'string', 'max:255'],
        'sgc_force' => ['required', 'string', 'max:255'],
        'sgc_expiry' => ['nullable', 'date'],
        'certificate_refused' => ['required', 'string', 'max:255'],
        'certificate_prevented' => ['required', 'string', 'max:255'],
    ];

    public function mount(): void
    {
        $this->user = User::where('id', Auth::id())->first();

        $this->surname = $this->user->surname;
        $this->forenames = $this->user->forenames;
        $this->home_phone = $this->user->home_phone;
        $this->mobile_phone = $this->user->mobile_phone;
        $this->address = $this->user->address;
        $this->previous_address = $this->user->previous_address;
        $this->date_of_birth = $this->user->date_of_birth;
        $this->occupation = $this->user->occupation;
        $this->nationality = $this->user->nationality;
        $this->convictions = $this->user->convictions;
        $this->clubs = $this->user->clubs;
        $this->primary_club = $this->user->primary_club;
        $this->membership_refused = $this->user->membership_refused;
        $this->qualifications = $this->user->qualifications;
        $this->experience = $this->user->experience;
        $this->fac_number = $this->user->fac_number;
        $this->fac_force = $this->user->fac_force;
        $this->fac_expiry = $this->user->fac_expiry;
        $this->sgc_number = $this->user->sgc_number;
        $this->sgc_force = $this->user->sgc_force;
        $this->sgc_expiry = $this->user->sgc_expiry;
        $this->certificate_refused = $this->user->certificate_refused;
        $this->certificate_prevented = $this->user->certificate_prevented;
    }

    public function submit()
    {
        $this->validate();

        $this->user->update([
            'surname' => $this->surname,
            'forenames' => $this->forenames,
            'home_phone' => $this->home_phone,
            'mobile_phone' => $this->mobile_phone,
            'address' => $this->address,
            'previous_address' => $this->previous_address,
            'date_of_birth' => $this->date_of_birth,
            'occupation' => $this->occupation,
            'nationality' => $this->nationality,
            'convictions' => $this->convictions,
            'clubs' => $this->clubs,
            'primary_club' => $this->primary_club,
            'membership_refused' => $this->membership_refused,
            'qualifications' => $this->qualifications,
            'experience' => $this->experience,
            'fac_number' => $this->fac_number,
            'fac_force' => $this->fac_force,
            'fac_expiry' => $this->fac_expiry,
            'sgc_number' => $this->sgc_number,
            'sgc_force' => $this->sgc_force,
            'sgc_expiry' => $this->sgc_expiry,
            'certificate_refused' => $this->certificate_refused,
            'certificate_prevented' => $this->certificate_prevented,
        ]);

        session()->flash('success', 'Application details updated.');
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.user-application-update');
    }
}
