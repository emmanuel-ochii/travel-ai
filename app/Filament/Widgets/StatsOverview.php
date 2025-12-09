<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\UserInteraction;
use App\Models\Booking; // If you have this model
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Registered Users')
                ->url(route('filament.admin.resources.users.index'))
                ->icon('heroicon-o-user-group'),

            Stat::make('AI Flight Searches', UserInteraction::where('type', 'search')->count())
                ->description('Searches logged from flight search form')
                ->icon('heroicon-o-magnifying-glass'),

            Stat::make('Bookings', Booking::count())
                ->description('Confirmed purchases')
                ->color('success')
                ->icon('heroicon-o-ticket'),
        ];
    }
}
