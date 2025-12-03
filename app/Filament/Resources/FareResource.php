<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FareResource\Pages;
use App\Filament\Resources\FareResource\RelationManagers;
use App\Models\Fare;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FareResource extends Resource
{
    protected static ?string $model = Fare::class;

    protected static ?string $navigationGroup = 'Travel Management';

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('flight_id')
                    ->label('Flight')
                    ->relationship('flight', 'flight_number')
                    ->required(),
                Forms\Components\Select::make('fare_class')
                    ->options([
                        'economy' => 'Economy',
                        'business' => 'Business',
                        'first' => 'First',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('price_cents')
                    ->label('Price (cents)')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('currency')
                    ->default('USD')
                    ->required(),
                Forms\Components\Checkbox::make('refundable')->label('Refundable'),
                Forms\Components\TextInput::make('baggage_allowance'),
                Forms\Components\Textarea::make('rules_json')
                    ->label('Rules JSON')
                    ->helperText('Enter JSON for fare rules')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('flight.flight_number')->label('Flight'),
                Tables\Columns\TextColumn::make('fare_class'),
                Tables\Columns\TextColumn::make('price_cents')->label('Price (cents)'),
                Tables\Columns\TextColumn::make('currency'),
                Tables\Columns\IconColumn::make('refundable'),
                Tables\Columns\TextColumn::make('baggage_allowance'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListFares::route('/'),
            'create' => Pages\CreateFare::route('/create'),
            'edit' => Pages\EditFare::route('/{record}/edit'),
        ];
    }
}
