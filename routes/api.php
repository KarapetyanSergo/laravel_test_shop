<?php

use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::middleware('auth:api')->post('logout', 'logout');
});

Route::prefix('categories')
    ->controller(CategoryController::class)
    ->middleware('auth:api')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{category}', 'show');
        Route::post('/', 'store');
        Route::delete('/{category}', 'destroy');
    });

Route::prefix('brands')
    ->controller(BrandController::class)
    ->middleware('auth:api')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{brand}', 'show');
        Route::post('/', 'store');
        Route::delete('/{brand}', 'destroy');
    });

Route::prefix('products')
    ->controller(ProductController::class)
    ->group(function () {
        Route::get('/',  'index');
        Route::get('/{product}', 'show');

        Route::middleware('auth:api')->group(function () {
            Route::post('/', 'store');
            Route::put('/{product}', 'update');
            Route::delete('/{product}', 'destroy');
        });
    });

Route::prefix('baskets')
    ->controller(BasketController::class)
    ->middleware('auth:api')
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::delete('/{basket}', 'destroy');
    });
