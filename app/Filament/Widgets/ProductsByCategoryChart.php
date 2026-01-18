<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Category;

class ProductsByCategoryChart extends ChartWidget
{
    public function getHeading(): string
    {
        return 'Visi Produkti';
    }

    protected function getData(): array
    {
        $categories = Category::withCount('products')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Produkti',
                    'data' => $categories->pluck('products_count'),
                    'backgroundColor' => '#f6be3b',
                ],
            ],
            'labels' => $categories->pluck('name'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected int|string|array $columnSpan = 'full';
}
