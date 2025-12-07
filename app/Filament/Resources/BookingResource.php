<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('flight_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('fare_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('passengers')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('total_price_cents')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('currency')
                    ->required()
                    ->maxLength(8)
                    ->default('USD'),

                // ✅ Status as Select Dropdown
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending'),

                Forms\Components\TextInput::make('booking_reference')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('flight_id')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('fare_id')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('passengers')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('total_price_cents')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('currency')->searchable(),

                // ✅ Status column as BadgeColumn
                Tables\Columns\BadgeColumn::make('status')
                    ->sortable()
                    ->colors([
                        'primary' => 'pending',
                        'success' => 'confirmed',
                        'danger' => 'cancelled',
                    ])
                    ->getStateUsing(fn(Booking $record) => match ($record->status) {
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        default => $record->status,
                    }),

                Tables\Columns\TextColumn::make('booking_reference')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // ✅ Removed confirm payment button because status is now editable
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
