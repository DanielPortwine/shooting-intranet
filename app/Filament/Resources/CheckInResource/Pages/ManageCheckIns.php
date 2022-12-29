<?php

namespace App\Filament\Resources\CheckInResource\Pages;

use App\Filament\Resources\CheckInResource;
use App\Filament\Resources\CheckInResource\Widgets\CheckInCode;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCheckIns extends ManageRecords
{
    protected static string $resource = CheckInResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            CheckInCode::class,
        ];
    }
}
