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
use Filament\Tables\Columns\{
    TextColumn,
    IconColumn,
    ImageColumn
};
use Filament\Tables\Filters\SelectFilter;
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
        return $table->columns([
            ImageColumn::make('image')
                ->label('Image')
                ->label('Attēls'),

            TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->label('Nosaukums'),

            TextColumn::make('sku')
                ->sortable()
                ->label('SKU'),

            TextColumn::make('price')
                ->money('EUR')
                ->label('Cena'),

            TextColumn::make('memory.value')
                ->label('Atmiņa'),

            TextColumn::make('color.value')
                ->label('Krāsa')
                ->placeholder('-'),

            TextColumn::make('category.name')
                ->label('Kategorija'),

            IconColumn::make('status')
                ->boolean()
                ->label('Pieejams'),
            ])
                ->filters([
            SelectFilter::make('status')
                ->label('Pieejams')
                ->options([
                    1 => 'Pieejams',
                    0 => 'Nav Pieejams',
                ]),

            SelectFilter::make('category_id')
                ->label('Kategorija')
                ->relationship('category', 'name'),

            SelectFilter::make('memory_id')
                ->label('Atmiņa')
                ->relationship('memory', 'value'),

            SelectFilter::make('color_id')
                ->label('Krāsa')
                ->relationship('color', 'value'),
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }
}
