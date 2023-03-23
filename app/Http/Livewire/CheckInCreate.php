<?php

namespace App\Http\Livewire;

use App\Models\CalendarItem;
use App\Models\CheckIn;
use App\Models\Firearm;
use App\Models\Package;
use App\Models\Payment;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;
use Livewire\Component;

class CheckInCreate extends Component
{
    public $token;
    public $firearms = [];
    public $guest;
    public $surname;
    public $forenames;
    public $email;
    public $home_phone;
    public $mobile_phone;
    public $name;
    public $password;
    public $password_confirmation;
    public $availableFirearms;
    public $guestDay = true;
    public $showingGuestCreate = false;

    protected $rules;

    public function __construct()
    {
        $this->rules = [
            'token' => 'required',
            'firearms' => 'required|array',
            'firearms.*' => 'numeric',
            'guest' => 'sometimes',
            'surname' => 'nullable|required_with:guest|string|max:25',
            'forenames' => 'nullable|required_with:guest|string|max:100',
            'email' => 'nullable|required_with:guest|string|max:255|unique:users',
            'home_phone' => 'nullable|required_with:guest|numeric',
            'mobile_phone' => 'nullable|required_with:guest|numeric',
            'name' => 'nullable|required_with:guest|string|max:25|unique:users',
            'password' => ['nullable', 'required_with:guest', 'string', new Password, 'confirmed'],
            'password_confirmation' => 'nullable|required_with:guest|string',
        ];
    }

    public function mount($token): void
    {
        $this->token = $token;
        $this->availableFirearms = Firearm::where('user_id', Auth::id())->orderBy('fac_number')->get();
    }

    public function createCheckIn()
    {
        $this->validate();

        $date = Carbon::now();

        $expectedToken = hash('sha256', config('app.check_in_secret') . $date->format('Y-m-d'));

        if ($this->token === $expectedToken) {
            $member = Auth()->user();
            $guestUser = User::create([
                'name' => $this->name,
                'surname' => $this->surname,
                'forenames' => $this->forenames,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'home_phone' => $this->home_phone,
                'mobile_phone' => $this->mobile_phone,
                'members_known_to' => $member->name,
                'member_sponsor' => $member->name,
            ]);

            $checkIn = CheckIn::create([
                'user_id' => $member->id,
                'date' => $date,
            ]);

            foreach($this->firearms as $firearm) {
                $checkIn->firearms()->attach($firearm);
            }

            $guestCheckIn = CheckIn::create([
                'user_id' => $guestUser->id,
                'date' => $date,
            ]);

            $guestDiscountPackage = Package::where('name', 'Guest Discount')->first();
            $guestUser->packages()->attach($guestDiscountPackage);
            Payment::create([
                'user_id' => $guestUser->id,
                'package_id' => $guestDiscountPackage->id,
                'price' => $guestDiscountPackage->price,
            ]);

            $visit = Visit::create([
                'user_id' => Auth::id(),
                'check_in_id' => $checkIn->id,
                'title' => 'Check-in',
                'description' => 'Auto-created visit from check-in on ' . $date->format('d M Y') . '. Edit this visit to upload pictures & videos and make it visible to the rest of the club.',
                'private' => true,
                'date' => Carbon::now(),
            ]);

            CalendarItem::create([
                'model_id' => $visit->id,
                'model_type' => Visit::class,
                'colour' => 'orange',
                'route' => 'visit-show',
            ]);

            return redirect()->route('visit-show', $visit->id);
        } else {
            $this->addError('token', 'Invalid token');
        }
    }

    public function render()
    {
        $date = new DateTime();

        $expectedToken = hash('sha256', config('app.check_in_secret') . $date->format('Y-m-d'));

        if (empty($this->token) || $this->token !== $expectedToken) {
            abort(403);
        }

        return view('livewire.check-in-create');
    }
}
