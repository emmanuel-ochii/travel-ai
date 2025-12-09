<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UserGrowthChart extends ChartWidget
{
    protected static ?string $heading = 'User Growth';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'New Users',
                    'data' => User::selectRaw('COUNT(*) as total')
                        ->groupByRaw('MONTH(created_at)')
                        ->pluck('total')
                        ->toArray(),
                ],
            ],
            'labels' => range(1, 12),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
