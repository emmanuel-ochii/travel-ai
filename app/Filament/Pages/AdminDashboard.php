<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\TopUsers;
use App\Filament\Widgets\UserGrowthChart;

class AdminDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';
    protected static string $view = 'filament.pages.admin-dashboard';
    protected static ?string $title = 'Admin Dashboard';

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            UserGrowthChart::class,
            TopUsers::class,
        ];
    }

    public function hasForm(): bool
    {
        return false;
    }
}
