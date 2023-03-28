<?php

namespace App\Filament\Resources\GuestDayResource\Widgets;

use App\Models\CalendarItem;
use App\Models\GuestDay;
use App\Models\RecurringGuestDay;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Filament\Forms;

class GuestDaysCreate extends Widget implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?RecurringGuestDay $recurringGuestDay;
    public $title;
    public int $day;
    public int $week;
    public $action = 'Setup';

    protected static string $view = 'filament.resources.guest-day-resource.widgets.guest-days-create';

    public function mount()
    {
        $this->recurringGuestDay = RecurringGuestDay::first();
        if (!empty($this->recurringGuestDay)) {
            $this->form->fill([
                'title' => $this->recurringGuestDay->title,
                'day' => $this->recurringGuestDay->day,
                'week' => $this->recurringGuestDay->week,
            ]);
            $this->action = 'Update';
        }
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\Select::make('day')->options(
                [
                    '1' => 'Monday',
                    '2' => 'Tuesday',
                    '3' => 'Wednesday',
                    '4' => 'Thursday',
                    '5' => 'Friday',
                    '6' => 'Saturday',
                    '7' => 'Sunday',
                ])
                ->required(),
            Forms\Components\TextInput::make('week')
                ->numeric()
                ->minValue(1)
                ->maxValue(4)
                ->label('Week Number')
                ->required(),
        ];
    }

    public function setup()
    {
        $this->recurringGuestDay = RecurringGuestDay::create($this->form->getState());

        $this->createFutureGuestDays();
        $this->action = 'Update';

        Notification::make()
            ->title('Setup successfully')
            ->success()
            ->send();
    }

    public function update()
    {
        $this->recurringGuestDay->update($this->form->getState());

        $this->recurringGuestDay->days()->where('date', '>', Carbon::now())->delete();

        $this->createFutureGuestDays();

        Notification::make()
            ->title('Updated successfully')
            ->success()
            ->send();
    }

    public function clear()
    {
        $this->recurringGuestDay->delete();

        unset($this->recurringGuestDay);
        unset($this->title);
        unset($this->day);
        unset($this->week);
        $this->action = 'Setup';

        Notification::make()
            ->title('Cleared successfully')
            ->success()
            ->send();
    }

    public function createFutureGuestDays()
    {
        $today = Carbon::today();
        $month = $today->month;
        $year = $today->year;

        for ($i = 0; $i < 12; $i++) {
            $firstDayOfMonth = Carbon::createFromDate($year, $month, 1);

            // Find the first occurrence of the desired day of the week
            $date = $firstDayOfMonth->dayOfWeekIso === $this->recurringGuestDay->day ?
                $firstDayOfMonth->copy() :
                $firstDayOfMonth->copy()->next($this->recurringGuestDay->day);

            // Add the desired number of weeks
            $date->addWeeks($this->recurringGuestDay->week - 1);

            // Check if the resulting date is still within the month
            if ($date->month == $month) {
                // Check if the date is in the future
                if ($date->greaterThanOrEqualTo($today)) {
                    $guestDay = GuestDay::create([
                        'date' => $date,
                        'title' => $this->recurringGuestDay->title,
                        'status' => 'active',
                        'recurring_guest_day_id' => $this->recurringGuestDay->id,
                    ]);
                    CalendarItem::create([
                        'model_id' => $guestDay->id,
                        'model_type' => GuestDay::class,
                        'colour' => 'yellow',
                    ]);
                }
            }

            // Increment month and adjust year if needed
            $month++;
            if ($month > 12) {
                $month = 1;
                $year++;
            }
        }
    }
}
