<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AvailabilityController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::middleware('auth:api')->post('logout', 'logout');
});


Route::prefix('category')
    ->controller(CategoryController::class)
    ->middleware('auth:api')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{category}', 'show');
        Route::post('/', 'store')
            ->middleware('can:create,'.CategoryController::class);
        Route::delete('/{category}', 'destroy')
            ->middleware('can:delete'.CategoryController::class);
    });


Route::prefix('brand')
    ->controller(BrandController::class)
    ->middleware('auth:api')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{brand}', 'show');
        Route::post('/', 'store')
            ->middleware('can:create,'.BrandController::class);
        Route::delete('/{brand}', 'destroy')
            ->middleware('can:delete'.BrandController::class);
        Route::put('status/{brand}', 'updateStatus')
            ->middleware('can:update-status,'.BrandController::class);
    });

Route::prefix('product')
    ->controller(ProductController::class)
    ->group(function () {
        Route::get('/',  'index');
        Route::get('/{product}', 'show');

        Route::middleware('auth:api')->group(function () {
            Route::post('/', 'store')
                ->middleware('can:create,'.ProductController::class);
            Route::delete('/{product}', 'destroy')
                ->middleware('can:delete,'.ProductController::class);;
        });
    });

Route::prefix('cart')
    ->controller(CartController::class)
    ->middleware('auth:api')
    ->group(function () {
        Route::get('/', 'index')
            ->middleware('can:view-any,'.CartController::class);
        Route::post('/', 'store')
            ->middleware('can:create,'.CartController::class);
        Route::delete('/', 'destroy')
            ->middleware('can:delete,'.CartController::class);
        Route::put('/', 'update')
            ->middleware('can:update,'.CartController::class);
    });

Route::prefix('availability')
    ->controller(AvailabilityController::class)
    ->middleware('auth:api')
    ->group(function () {
        Route::put('/', 'update')
            ->middleware('can:update,'.AvailabilityController::class);
    });

Route::prefix('order')
    ->controller(OrderController::class)
    ->middleware('auth:api')
    ->group(function () {
        Route::post('/', 'create')
            ->middleware('can:update,'.OrderController::class);
    });
