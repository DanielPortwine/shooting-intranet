<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        $members = User::whereNotNull('approved_at')->get()->pluck('name', 'name');

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->required(),
                Forms\Components\CheckboxList::make('roles')
                    ->relationship('roles', 'name')
                    ->columns(),
                Forms\Components\CheckboxList::make('permissions')
                    ->relationship('permissions', 'name')
                    ->columns(),
                Forms\Components\TextInput::make('surname')->required(),
                Forms\Components\TextInput::make('forenames')->required(),

                Forms\Components\TextInput::make('home_phone')->required(),
                Forms\Components\TextInput::make('mobile_phone')->required(),

                Forms\Components\TextInput::make('address')->required(),
                Forms\Components\TextInput::make('previous_address')->required(),

                Forms\Components\DatePicker::make('date_of_birth')->required(),
                Forms\Components\TextInput::make('occupation')->required(),

                Forms\Components\TextInput::make('nationality')->required(),
                Forms\Components\TextInput::make('convictions')->required(),

                Forms\Components\TextInput::make('clubs')->required(),
                Forms\Components\TextInput::make('primary_club')->required(),

                Forms\Components\TextInput::make('membership_refused')->required(),
                Forms\Components\TextInput::make('qualifications')->required(),

                Forms\Components\TextInput::make('experience')->required(),

                Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('fac_number')->required(),
                        Forms\Components\TextInput::make('fac_force')->required(),
                        Forms\Components\DatePicker::make('fac_expiry'),
                    ]),

                Grid::make(3)
                    ->schema([
                        Forms\Components\TextInput::make('sgc_number')->required(),
                        Forms\Components\TextInput::make('sgc_force')->required(),
                        Forms\Components\DatePicker::make('sgc_expiry'),
                ]),

                Forms\Components\TextInput::make('certificate_refused')->required(),
                Forms\Components\TextInput::make('certificate_prevented')->required(),

                Forms\Components\Select::make('members_known_to')->options($members)->multiple(),
                Forms\Components\Select::make('member_sponsor')->options($members),

                Forms\Components\FileUpload::make('identification_1')->required(),
                Forms\Components\FileUpload::make('identification_2'),

                Forms\Components\FileUpload::make('reference'),
                Forms\Components\FileUpload::make('signature')->required(),

                Forms\Components\Checkbox::make('section_21')->required(),
                Forms\Components\DatePicker::make('approved_at')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('surname')->searchable(),
                Tables\Columns\TextColumn::make('forenames')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('home_phone')->searchable(),
                Tables\Columns\TextColumn::make('mobile_phone')->searchable(),
                Tables\Columns\TextColumn::make('address')->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')->searchable(),
                Tables\Columns\TextColumn::make('member_sponsor')->searchable(),
                Tables\Columns\TextColumn::make('approved_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
