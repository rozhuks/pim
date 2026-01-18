<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::with(['category', 'memory', 'color'])->get()->map(function ($product) {
            return [
                'name' => $product->name,
                'sku' => $product->sku,
                'price' => $product->price,
                'category' => $product->category?->name,
                'memory' => $product->memory?->value,
                'color' => $product->color?->value,
                'status' => $product->status ? 'available' : 'not_available',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'name',
            'sku',
            'price',
            'category',
            'memory',
            'color',
            'status',
        ];
    }
}
