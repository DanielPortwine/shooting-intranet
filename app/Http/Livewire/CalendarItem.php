<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class CalendarItem extends Component
{
    public $lastDay;
    public $item;
    public $dayLoop;
    public $dropdownAlign;
    public $above;
    public $firstDayLastWeek;
    protected $listeners = ['refresh'];

    public function mount(): void
    {
        if (($this->dayLoop % 7) + 1 <= 4) {
            $this->dropdownAlign = 'left';
        } else {
            $this->dropdownAlign = 'right';
        }

        $this->firstDayLastWeek = Carbon::parse($this->lastDay)->startOfWeek(config('calendar.weekStartDay'))->format('Y-m-d');
        if ($this->item->model->date >= $this->firstDayLastWeek) {
            $this->above = true;
        }
    }

    public function refresh()
    {
        $this->item = $this->item->fresh();
    }

    public function render()
    {
        return view('livewire.calendar-item');
    }
}
