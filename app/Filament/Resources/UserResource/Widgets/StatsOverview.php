<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getCards(): array
    {
        $users = User::get();
        $members = $users->whereNotNull('approved_at');
        $thisYearMembers = $members->where('approved_at', '>=', Carbon::now()->startOfYear());
        $lastYearMembers = $members->whereBetween('approved_at', [Carbon::now()->subYear()->startOfYear(), Carbon::now()->startOfYear()]);
        $thisMonthMembers = $members->where('approved_at', '>=', Carbon::now()->startOfMonth());
        $thisMonthApplications = $users->where('created_at', '>=', Carbon::now()->startOfMonth());

        return [
            Card::make('Total Members', $members->count()),
//                ->description($thisMonthMembers->count().' this month'),
            Card::make('New Members This Month', $thisMonthMembers->count()),
//                ->description('% increase')
//                ->descriptionIcon('heroicon-s-trending-down'),
            Card::make('Applications This Month', $thisMonthApplications->count()),
//                ->description($thisYearMembers->count() != $members->count() ? round($thisYearMembers->count()/($members->count()-$thisYearMembers->count())*100).'%' : '-')
//                ->descriptionIcon('heroicon-s-trending-up'),
        ];
    }
}
