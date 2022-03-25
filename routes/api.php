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

Route::group(['middleware' => ['auth:api', 'can:check-admin,'.CategoryController::class]], function () {
    Route::prefix('categories')
        ->controller(CategoryController::class)
        ->group(function () {
            Route::get('/', 'index');
            Route::get('/{category}', 'show');
            Route::post('/', 'store');
            Route::delete('/{category}', 'destroy');
        });
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

        Route::group(['middleware' => ['auth:api', 'can:check-merchant,'.ProductController::class]], function () {
                Route::post('/', 'store');
                Route::delete('/{product}', 'destroy');
            });
    });

Route::group(['middleware' => ['auth:api', 'can:check-customer,'.BasketController::class]], function () {
    Route::prefix('baskets')
        ->controller(BasketController::class)
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::delete('/{basket}', 'destroy');
        });
});

