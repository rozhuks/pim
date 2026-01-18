<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Category;

class ProductsByCategoryChart extends ChartWidget
{
    public function getHeading(): string
    {
        return 'Products by category';
    }

    protected function getData(): array
    {
        $categories = Category::withCount('products')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Products',
                    'data' => $categories->pluck('products_count'),
                    'backgroundColor' => '#3b82f6',
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
