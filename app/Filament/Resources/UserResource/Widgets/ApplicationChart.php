<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\BarChartWidget;

class ApplicationChart extends BarChartWidget
{
    protected static ?string $heading = 'Applications';

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
        $members = User::where('created_at', '>=', Carbon::now()->subYear())->get();
        $monthsData = [];
        for ($month = 11; $month >= 0; $month--) {
            $monthsData[Carbon::now()->subMonth($month)->format('M')] =
                $members
                    ->whereBetween('created_at', [
                        Carbon::now()->subMonth($month)->firstOfMonth()->format('Y-m-d'),
                        Carbon::now()->subMonth($month)->lastOfMonth()->format('Y-m-d')
                    ])
                    ->count();
        }

        return [
            'datasets' => [
                [
                    'data' => $monthsData,
                    'backgroundColor' => '#6b7280',
                ],
            ],
        ];
    }
}
