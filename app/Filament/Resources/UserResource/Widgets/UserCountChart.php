<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\LineChartWidget;
use Illuminate\Support\Facades\Log;

class UserCountChart extends LineChartWidget
{
    protected static ?string $heading = 'Total Members';

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
        $members = User::whereNotNull('approved_at')->get();
        $monthsData = [];
        for ($month = 11; $month >= 0; $month--) {
            $monthsData[Carbon::now()->subMonth($month)->format('M')] =
                $members
                    ->where('approved_at', '<', Carbon::now()->subMonth($month)->lastOfMonth()->format('Y-m-d'))
                    ->count();
        }

        return [
            'datasets' => [
                [
                    'data' => $monthsData,
                ],
            ],
        ];
    }
}
