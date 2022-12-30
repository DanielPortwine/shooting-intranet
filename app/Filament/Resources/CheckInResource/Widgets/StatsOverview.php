<?php

namespace App\Filament\Resources\CheckInResource\Widgets;

use App\Models\CheckIn;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getCards(): array
    {
        $checkIns = CheckIn::get();
        $mostDedicatedMember = User::with(['checkIns'])
            ->withCount(['checkIns' => function ($q) {
                return $q->where('created_at', '>=', Carbon::now()->startOfMonth());
            }])
            ->orderByDesc('check_ins_count')
            ->first();
        $thisMonthCheckIns = $checkIns->where('created_at', '>=', Carbon::now()->startOfMonth());
        $todayCheckIns = $checkIns->where('created_at', '>=', Carbon::now()->startOfDay());

        return [
            Card::make('Most Dedicated Member', $mostDedicatedMember->name . ' (' . $mostDedicatedMember->check_ins_count . ')'),
            Card::make('Check-ins This Month', $thisMonthCheckIns->count()),
            Card::make('Check-ins Today', $todayCheckIns->count()),
        ];
    }
}
