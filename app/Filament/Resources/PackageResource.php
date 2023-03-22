<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('price')->required(),
                Forms\Components\Select::make('recurring')
                    ->options([
//                        'weekly' => 'Weekly',
//                        'monthly' => 'Monthly',
                        'annually' => 'Annually',
                    ])
                    ->default('annually'),
                Forms\Components\DatePicker::make('recurring_start_date'),
                Forms\Components\Checkbox::make('pro_rata'),
                Forms\Components\Checkbox::make('charge_full_first'),
                Forms\Components\Select::make('excludedPackages')
                    ->multiple()
                    ->preload()
                    ->relationship('excludedPackages', 'name'),
                Forms\Components\Select::make('requiredPackages')
                    ->multiple()
                    ->preload()
                    ->relationship('requiredPackages', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('price')->searchable(),
                Tables\Columns\TextColumn::make('recurring'),
                Tables\Columns\TextColumn::make('recurring_start_date')->date('j M, Y'),
                Tables\Columns\IconColumn::make('pro_rata')->boolean(),
                Tables\Columns\IconColumn::make('charge_full_first')->boolean(),
                Tables\Columns\TextColumn::make('count')->counts('payments'),
                Tables\Columns\ViewColumn::make('excludedPackages')->view('filament.tables.columns.excluded-packages'),
                Tables\Columns\ViewColumn::make('requiredPackages')->view('filament.tables.columns.required-packages'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePackages::route('/'),
        ];
    }
}
