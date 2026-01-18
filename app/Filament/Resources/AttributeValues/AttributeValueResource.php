<?php

namespace App\Filament\Resources\AttributeValues;

use App\Filament\Resources\AttributeValues\Pages\CreateAttributeValue;
use App\Filament\Resources\AttributeValues\Pages\EditAttributeValue;
use App\Filament\Resources\AttributeValues\Pages\ListAttributeValues;
use App\Filament\Resources\AttributeValues\Schemas\AttributeValueForm;
use App\Filament\Resources\AttributeValues\Tables\AttributeValuesTable;
use App\Models\AttributeValue;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class AttributeValueResource extends Resource
{
    protected static ?string $model = AttributeValue::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('attribute_id')
                ->label('Attribute')
                ->relationship('attribute', 'name')
                ->required(),

            TextInput::make('value')
                ->label('Vērtība')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('attribute.name')
                ->label('Attribute')
                ->sortable(),

            TextColumn::make('value')
                ->label('Vērtība')
                ->sortable()
                ->searchable(),
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
            'index' => ListAttributeValues::route('/'),
            'create' => CreateAttributeValue::route('/create'),
            'edit' => EditAttributeValue::route('/{record}/edit'),
        ];
    }
}
