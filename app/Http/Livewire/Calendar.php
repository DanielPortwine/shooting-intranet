<?php

namespace App\Http\Livewire;

use App\Models\CalendarItem;
use App\Models\Competition;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Calendar extends Component
{
    public $year;
    public $month;
    public $week;
    public $day;
    public $lastDay;
    public $view;
    public $days = [];
    public $today;
    public $selectedMonth;
    public $dayNames;
    protected $listeners = ['generateMonth'];

    public function mount(): void
    {
        $this->today = Carbon::now()->format('Y-m-d');
        $this->lastDay = Carbon::parse($this->selectedMonth)->lastOfMonth()->startOfWeek(config('calendar.weekStartDay'))->format('Y-m-d');

        if (empty($this->year)) {
            $this->year = Carbon::now()->year;
        }

        if (empty($this->month)) {
            $this->month = Carbon::now()->month;
        }

        $this->selectedMonth = Carbon::parse($this->year . '-' . $this->month)->format('Y-m-d');

        $this->generateMonth();

        for ($i = 0; $i < 7; $i++) {
            $day = Carbon::now()->startOfWeek(config('calendar.weekStartDay'))->addDays($i);
            $this->dayNames[] = $day->shortDayName;
        }
    }

    public function generateMonth()
    {
        $this->year = Carbon::parse($this->selectedMonth)->year;
        $this->month = Carbon::parse($this->selectedMonth)->month;
        $this->days = [];
        $this->lastDay = Carbon::parse($this->selectedMonth)->lastOfMonth()->startOfWeek(config('calendar.weekStartDay'))->format('Y-m-d');

        $calendarItems = CalendarItem::with('model')
            ->whereHas('model', function($query) {
                $query->whereBetween('date', [
                        Carbon::parse($this->selectedMonth)->startOfWeek(config('calendar.weekStartDay')),
                        Carbon::parse($this->selectedMonth)->lastOfMonth()->endOfWeek(config('calendar.weekEndDay'))
                    ]);
                })
            ->get()
            ->sortBy('model.date');

        // add days from previous month to the first week of this month
        $startOfMonth = Carbon::parse($this->selectedMonth)->startOfMonth();
        $startOfWeek = Carbon::parse($this->selectedMonth)->startOfWeek(config('calendar.weekStartDay'));
        $daysInWeek = $startOfWeek->diffInDays($startOfMonth);
        if ($daysInWeek > 0) {
            for ($x = 0; $x < $daysInWeek; $x++) {
                $date = Carbon::parse($startOfMonth)->subDays($daysInWeek - $x)->format('Y-m-d');
                $this->days[$date] = [];
            }
        }

        // add this month's days
        for ($x = 1; $x <= Carbon::parse($this->selectedMonth)->endOfMonth()->format('j'); $x++) {
            $date = Carbon::parse($this->year . '-' . $this->month . '-' . $x)->format('Y-m-d');
            $this->days[$date] = [];
        }

        // add days of next month to final week of this month
        $endOfMonth = Carbon::parse($this->selectedMonth)->lastOfMonth();
        $endOfWeek = Carbon::parse($this->selectedMonth)->lastOfMonth()->endOfWeek(config('calendar.weekEndDay'));
        $daysInWeek = $endOfWeek->diffInDays($endOfMonth);
        if ($daysInWeek > 0) {
            for ($x = 1; $x <= $daysInWeek; $x++) {
                $date = $endOfMonth->addDays()->format('Y-m-d');
                $this->days[$date] = [];
            }
        }

        foreach($calendarItems as $calendarItem) {
            $this->days[$calendarItem->model->date->format('Y-m-d')][] = $calendarItem;
        }
    }

    public function today()
    {
        $this->selectedMonth = Carbon::now()->format('Y-m-d');

        $this->generateMonth();
    }

    public function previous()
    {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)->subMonth()->format('Y-m-d');

        $this->generateMonth();
    }

    public function next()
    {
        $this->selectedMonth = Carbon::parse($this->selectedMonth)->addMonth()->format('Y-m-d');

        $this->generateMonth();
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
