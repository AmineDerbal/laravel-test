<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('products.index');
    Route::post('/', 'store')->name('products.store');

});
