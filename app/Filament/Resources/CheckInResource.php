<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CheckInResource\Pages;
use App\Filament\Resources\CheckInResource\RelationManagers;
use App\Filament\Resources\CheckInResource\Widgets\CheckInCode;
use App\Models\CheckIn;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CheckInResource extends Resource
{
    protected static ?string $model = CheckIn::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Select::make('user_id')->relationship('user', 'name')->required(),
                Forms\Components\TextInput::make('firearm')->required(),
                Forms\Components\DatePicker::make('date')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->searchable(),
                Tables\Columns\TextColumn::make('firearm'),
                Tables\Columns\TextColumn::make('created_at')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCheckIns::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            CheckInCode::class,
        ];
    }
}
