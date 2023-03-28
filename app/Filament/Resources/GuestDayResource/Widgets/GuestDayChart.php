<?php

namespace App\Filament\Resources\GuestDayResource\Widgets;

use App\Models\GuestDay;
use Carbon\Carbon;
use Filament\Widgets\BarChartWidget;

class GuestDayChart extends BarChartWidget
{
    protected static ?string $heading = 'Guest Attendance';

    protected static ?string $pollingInterval = null;

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected function getData(): array
    {
        $data = [];
        $guestDays = GuestDay::where('date', '>=', Carbon::now()->subYear())->get();
        foreach ($guestDays as $guestDay) {
            $data[(string)$guestDay->date->format('Y-m-d')] = $guestDay->guests->count();
        }

        return [
            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => '#6b7280',
                ],
            ],
        ];
    }
}
