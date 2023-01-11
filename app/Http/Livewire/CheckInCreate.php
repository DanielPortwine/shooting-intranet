<?php

namespace App\Http\Livewire;

use App\Models\CalendarItem;
use App\Models\CheckIn;
use App\Models\Firearm;
use App\Models\Visit;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CheckInCreate extends Component
{
    public $token;
    public $firearm;
    public $firearms = [];
    public $availableFirearms;

    protected $rules = [
        'token' => 'required',
        'firearm' => 'sometimes',
        'firearms' => 'sometimes|array',
        'firearms.*' => 'numeric',
    ];

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
            if (count($this->firearms) === 1 && $this->firearms[0] == 0) {
                $this->firearm = 'Club Gun';
                $this->firearms = [];
            }

            $checkIn = CheckIn::create([
                'user_id' => Auth::id(),
                'firearm' => $this->firearm,
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
