<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\{
    TextInput,
    Select,
    Toggle,
    FileUpload,
    Textarea
};
use App\Models\AttributeValue;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            FileUpload::make('image')
                ->image()
                ->directory('products'),

            TextInput::make('name')
                ->required(),

            TextInput::make('sku')
                ->required()
                ->unique(ignoreRecord: true),

            TextInput::make('price')
                ->numeric()
                ->required(),

            Select::make('category_id')
                ->relationship('category', 'name')
                ->required(),

            Select::make('memory_id')
                ->label('Atmiņa')
                ->options(
                    AttributeValue::whereHas('attribute', fn ($q) =>
                        $q->where('name', 'Atmiņa')
                    )->pluck('value', 'id')
                )
                ->searchable(),

            Select::make('color_id')
                ->label('Krāsa')
                ->options(
                    AttributeValue::whereHas('attribute', fn ($q) =>
                        $q->where('name', 'Krāsa')
                    )->pluck('value', 'id')
                )
                ->searchable(),

            Toggle::make('status')
                ->label('Pieejams')
                ->default(true),

            Textarea::make('description'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
