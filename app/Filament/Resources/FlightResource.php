<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlightResource\Pages;
use App\Filament\Resources\FlightResource\RelationManagers;
use App\Models\Flight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlightResource extends Resource
{
    protected static ?string $model = Flight::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Travel Management';
    protected static ?string $navigationLabel = 'Flights';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('airline_id')
                    ->relationship('airline', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('origin_airport_id')
                    ->relationship('origin', 'city')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('destination_airport_id')
                    ->relationship('destination', 'city')
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('flight_number')
                    ->required()
                    ->maxLength(20),

                Forms\Components\DateTimePicker::make('depart_at')
                    ->required(),

                Forms\Components\DateTimePicker::make('arrive_at')
                    ->required(),

                Forms\Components\TextInput::make('duration_minutes')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('stops')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('base_price_cents')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('currency')
                    ->default('USD')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('flight_number')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('airline.name')->label('Airline')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('origin.city')->label('From')->sortable(),
                Tables\Columns\TextColumn::make('destination.city')->label('To')->sortable(),
                Tables\Columns\TextColumn::make('depart_at')->label('Departure')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('arrive_at')->label('Arrival')->dateTime()->sortable(),
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
            'index' => Pages\ListFlights::route('/'),
            'create' => Pages\CreateFlight::route('/create'),
            'edit' => Pages\EditFlight::route('/{record}/edit'),
        ];
    }
}
