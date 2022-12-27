<?php

namespace App\Http\Livewire;

use App\Models\CheckIn;
use App\Models\Visit;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CheckInCreate extends Component
{
    public $token;
    public $firearm;

    protected $rules = [
        'token' => 'required',
        'firearm' => 'required',
    ];

    public function mount($token): void
    {
        $this->token = $token;
    }

    public function createCheckIn()
    {
        $this->validate();

        $date = new DateTime();

        $expectedToken = hash('sha256', config('app.check_in_secret') . $date->format('Y-m-d'));

        if ($this->token === $expectedToken) {
            $checkIn = CheckIn::create([
                'user_id' => Auth::id(),
                'firearm' => $this->firearm,
            ]);

            $visit = Visit::create([
                'user_id' => Auth::id(),
                'check_in_id' => $checkIn->id,
                'description' => 'Auto-created visit from check-in on ' . $date->format('d M Y') . '. Edit this visit to upload pictures & videos and make it visible to the rest of the club.',
                'private' => true,
            ]);

            return redirect()->route('visits', $visit->id);
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
