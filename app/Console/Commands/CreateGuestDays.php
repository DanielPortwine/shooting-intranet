<?php

namespace App\Console\Commands;

use App\Models\CalendarItem;
use App\Models\GuestDay;
use App\Models\RecurringGuestDay;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateGuestDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'guest-days:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a guest day for this time next year if it is recurring.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $recurringGuestDay = RecurringGuestDay::first();

        $firstDayOfMonth = Carbon::now()->addYear()->firstOfMonth();

        // Find the first occurrence of the desired day of the week
        $date = $firstDayOfMonth->dayOfWeekIso === $recurringGuestDay->day ?
            $firstDayOfMonth->copy() :
            $firstDayOfMonth->copy()->next($recurringGuestDay->day);

        // Add the desired number of weeks
        $date->addWeeks($recurringGuestDay->week - 1);

        if (GuestDay::where('date', $date)->where('recurring_guest_day_id', $recurringGuestDay->id)->count() === 0) {
            $guestDay = GuestDay::create([
                'date' => $date,
                'title' => $recurringGuestDay->title,
                'status' => 'active',
                'recurring_guest_day_id' => $recurringGuestDay->id,
            ]);

            CalendarItem::create([
                'model_id' => $guestDay->id,
                'model_type' => GuestDay::class,
                'colour' => 'yellow',
            ]);
        }

        return Command::SUCCESS;
    }
}
