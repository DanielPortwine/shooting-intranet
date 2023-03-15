<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Package;
use App\Models\Payment;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('package_id')
                    ->relationship('package', 'name')
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        if ($state) {
                            $set('price', Package::find($state)->price);
                        }
                    })
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->prefix('£')
                    ->numeric()
                    ->minValue(0)
                    ->required(),
                Forms\Components\Select::make('payment_method')
                    ->options(config('payments.methods')),
                Forms\Components\DatePicker::make('due_date'),
                Forms\Components\DatePicker::make('reminder_date'),
                Forms\Components\DateTimePicker::make('paid_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->searchable(),
                Tables\Columns\TextColumn::make('package.name')->searchable(),
                Tables\Columns\TextColumn::make('price')->searchable(),
                Tables\Columns\TextColumn::make('payment_method'),
                Tables\Columns\TextColumn::make('paid_at')->date('j M, Y'),
                Tables\Columns\TextColumn::make('due_date')->date('j M, Y'),
                Tables\Columns\TextColumn::make('reminder_date')->date('j M, Y'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('package')
                    ->multiple()
                    ->relationship('package', 'name'),
                Tables\Filters\SelectFilter::make('payment_method')
                    ->multiple()
                    ->options([
                        'card' => 'Card',
                        'bank' => 'Bank Transfer',
                        'cash' => 'Cash',
                    ]),
                Tables\Filters\Filter::make('paid_at')
                    ->query(fn (Builder $query): Builder => $query->whereNull('paid_at'))
                    ->label('Not Paid'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePayments::route('/'),
        ];
    }
}
