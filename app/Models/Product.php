<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public static function getNavigationLabel(): string
    {
        return 'Produ12cts';
    }

    protected $fillable = [
        'name',
        'sku',
        'price',
        'category_id',
        'memory_id',
        'color_id',
        'status',
        'description',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function memory()
    {
        return $this->belongsTo(AttributeValue::class, 'memory_id');
    }

    public function color()
    {
        return $this->belongsTo(AttributeValue::class, 'color_id');
    }
}
