<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Product;

class ProductStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Visi produkti', Product::count())
                ->description('Visi produkti sistēmā')
                ->icon('heroicon-o-archive-box'),

            Stat::make('Pieejamie produkti', Product::where('status', true)->count())
                ->description('Pašlaik pieejami')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Nav pieejamie produkti', Product::where('status', false)->count())
                ->description('Pašlaik nav pieejami')
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }

    protected function getType(): string
    {
        return 'polarArea';
    }

}