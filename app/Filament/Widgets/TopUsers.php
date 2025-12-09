<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class TopUsers extends TableWidget
{
    protected static ?string $heading = 'Top Platform Users';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::withCount('searchInteractions')
                    ->orderByDesc('search_interactions_count')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('User'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('search_interactions_count')
                    ->label('Searches')
                    ->sortable()->color('primary'),

                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->label('Joined'),
            ]);
    }
}
