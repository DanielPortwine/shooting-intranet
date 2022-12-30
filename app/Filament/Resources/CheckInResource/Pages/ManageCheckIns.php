<?php

namespace App\Filament\Resources\CheckInResource\Pages;

use App\Filament\Resources\CheckInResource;
use App\Filament\Resources\CheckInResource\Widgets\CheckInChart;
use App\Filament\Resources\CheckInResource\Widgets\CheckInCode;
use App\Filament\Resources\CheckInResource\Widgets\StatsOverview;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCheckIns extends ManageRecords
{
    protected static string $resource = CheckInResource::class;

    protected function getActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
            CheckInChart::class,
            CheckInCode::class,
        ];
    }
}
