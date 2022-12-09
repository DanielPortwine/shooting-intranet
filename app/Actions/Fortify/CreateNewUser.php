<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
//     * @param  array  $input
     * @return \App\Models\User
     */
    public function create($input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:25', 'unique:users'],
            'surname' => ['required', 'string', 'max:25'],
            'forenames' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
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
            'identification_1' => ['required', 'image'],
            'identification_2' => ['image'],
            'members_known_to' => ['required', 'string', 'max:255'],
            'member_sponsor' => ['required', 'string', 'max:25'],
            'reference' => ['nullable', 'file', 'mimes:pdf,docx.txt'],
            'section_21' => ['required', 'accepted'],
            'signature' => ['required', 'image'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $files = [
            'identification_1' => $input['identification_1']->store('identification'),
            'identification_2' => array_key_exists('identification_2', $input) ? $input['identification_2']->store('identification') : null,
            'reference' => array_key_exists('reference', $input) ? $input['reference']->store('references') : null,
            'signature' => $input['signature']->store('signatures'),
        ];

        return DB::transaction(function () use ($input, $files) {
            return tap(User::create([
                'name' => $input['name'],
                'surname' => $input['surname'],
                'forenames' => $input['forenames'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'home_phone' => $input['home_phone'],
                'mobile_phone' => $input['mobile_phone'],
                'address' => $input['address'],
                'previous_address' => $input['previous_address'],
                'date_of_birth' => $input['date_of_birth'],
                'occupation' => $input['occupation'],
                'nationality' => $input['nationality'],
                'convictions' => $input['convictions'],
                'clubs' => $input['clubs'],
                'primary_club' => $input['primary_club'],
                'membership_refused' => $input['membership_refused'],
                'qualifications' => $input['qualifications'],
                'experience' => $input['experience'],
                'fac_number' => $input['fac_number'],
                'fac_force' => $input['fac_force'],
                'fac_expiry' => $input['fac_expiry'],
                'sgc_number' => $input['sgc_number'],
                'sgc_force' => $input['sgc_force'],
                'sgc_expiry' => $input['sgc_expiry'],
                'certificate_refused' => $input['certificate_refused'],
                'certificate_prevented' => $input['certificate_prevented'],
                'identification_1' => $files['identification_1'],
                'identification_2' => $files['identification_2'],
                'members_known_to' => $input['members_known_to'],
                'member_sponsor' => $input['member_sponsor'],
                'reference' => $files['reference'],
                'section_21' => (bool)$input['section_21'],
                'signature' => $files['signature'],
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
