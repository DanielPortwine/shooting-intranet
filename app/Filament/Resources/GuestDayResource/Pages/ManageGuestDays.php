<?php

namespace App\Filament\Resources\GuestDayResource\Pages;

use App\Filament\Resources\GuestDayResource;
use App\Models\CalendarItem;
use App\Models\GuestDay;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGuestDays extends ManageRecords
{
    protected static string $resource = GuestDayResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->after(function (array $data) {
                $guestDay = GuestDay::where('date', $data['date'])->first();
                CalendarItem::create([
                    'model_id' => $guestDay->id,
                    'model_type' => GuestDay::class,
                    'colour' => 'yellow',
                ]);
            }),
        ];
    }
}
