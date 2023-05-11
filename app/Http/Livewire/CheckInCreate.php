<?php

namespace App\Http\Livewire;

use App\Models\Award;
use App\Models\CalendarItem;
use App\Models\CheckIn;
use App\Models\Firearm;
use App\Models\GuestDay;
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
    public $guestDay = false;
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
        $this->guestDay = GuestDay::where('date', Carbon::now()->format('Y-m-d'))->count() > 0;
    }

    public function updatedShowingGuestCreate($value)
    {
        $this->guest = $value;
    }

    public function createCheckIn()
    {
        $this->validate();

        $date = Carbon::now();

        $expectedToken = hash('sha256', config('app.check_in_secret') . $date->format('Y-m-d'));

        if ($this->token === $expectedToken) {
            $member = Auth()->user();
            if ($this->showingGuestCreate) {
                $guestUser = User::firstOrCreate(
                    [
                        'email' => $this->email,
                    ],
                    [
                        'name' => $this->name,
                        'surname' => $this->surname,
                        'forenames' => $this->forenames,
                        'email' => $this->email,
                        'password' => Hash::make($this->password),
                        'home_phone' => $this->home_phone,
                        'mobile_phone' => $this->mobile_phone,
                        'members_known_to' => [$member->name],
                        'member_sponsor' => $member->name,
                    ]
                );

                $this->checkInUser($guestUser, $date);

                $guestDiscountPackage = Package::where('name', 'Guest Discount')->first();
                Payment::create([
                    'user_id' => $guestUser->id,
                    'package_id' => $guestDiscountPackage->id,
                    'price' => $guestDiscountPackage->price,
                ]);

                $guestDay = GuestDay::with(['guests'])->where('date', Carbon::now()->format('Y-m-d'))->first();
                $guestDay->guests()->attach($guestUser, ['host_id' => $member->id, 'created_at' => now()]);

                $hostAward = Award::where('name', 'Host')->first();
                foreach ($hostAward->levels as $level) {
                    if ($level->threshold === $member->fresh()->guestDaysHosted->count()) {
                        $member->awards()->attach($level);
                    }
                }
            }

            $visit = $this->checkInUser($member, $date);

            return redirect()->route('visit-show', $visit->id);
        } else {
            $this->addError('token', 'Invalid token');
        }
    }

    public function checkInUser($user, $date)
    {
        $checkIn = CheckIn::create([
            'user_id' => $user->id,
            'date' => $date,
        ]);

        foreach($this->firearms as $firearm) {
            $checkIn->firearms()->attach($firearm);
        }

        $visit = Visit::create([
            'user_id' => Auth::id(),
            'check_in_id' => $checkIn->id,
            'title' => 'Check-in',
            'description' => 'Auto-created visit from check-in on ' . $date->format('d M Y') . '. Edit this visit to upload pictures & videos and make it visible to the rest of the club.',
            'private' => true,
            'date' => $date,
        ]);

        $visitorAward = Award::where('name', 'Visitor')->first();
        foreach ($visitorAward->levels as $level) {
            if ($level->threshold === $user->fresh()->checkIns->count()) {
                $user->awards()->attach($level);
            }
        }

        $secondHomeAward = Award::where('name', 'Second Home')->first();
        $checkIns = $user->checkIns()->whereDate('date', '<=', $date->format('Y-m-d'))->get()->unique(function ($item) {
            return $item->date->format('Y-m-d');
        })->sortByDesc('date')->values();

        $currentDay = $date->copy();
        foreach ($checkIns as $checkIn) {
            if ($checkIn->date->format('Y-m-d') === $currentDay->format('Y-m-d')) {
                $currentDay->subDay();
            } else {
                break;
            }
        }

        $streak = $date->diffInDays($currentDay);
        foreach ($secondHomeAward->levels as $level) {
            if ($level->threshold === $streak && !$user->awards->contains($level)) {
                $user->awards()->attach($level);
            }
        }

        CalendarItem::create([
            'model_id' => $visit->id,
            'model_type' => Visit::class,
            'colour' => 'orange',
            'route' => 'visit-show',
        ]);

        return $visit;
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
