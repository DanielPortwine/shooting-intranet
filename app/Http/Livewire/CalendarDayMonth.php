<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class CalendarDayMonth extends Component
{
    public $lastDay;
    public $day;
    public $items;
    public $dayLoop;
    public $today;

    public function mount(): void
    {
        $this->today = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.calendar-day-month');
    }
}
