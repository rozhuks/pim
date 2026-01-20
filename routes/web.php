<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;

Route::get('/', [ShopController::class, 'index'])->name('shop.index');

Route::get('/product-image/{filename}', function ($filename) {
    $path = storage_path('app/private/products/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');