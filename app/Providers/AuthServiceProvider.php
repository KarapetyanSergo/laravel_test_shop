<?php

namespace App\Providers;

use App\Http\Controllers\Api\AvailabilityController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Policies\AvailabilityPolicy;
use App\Policies\CartPolicy;
use App\Policies\BrandPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        UserController::class => UserPolicy::class,
        CartController::class => CartPolicy::class,
        ProductController::class => ProductPolicy::class,
        CategoryController::class => CategoryPolicy::class,
        BrandController::class => BrandPolicy::class,
        AvailabilityController::class => AvailabilityPolicy::class,
        OrderController::class => OrderPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (!$this->app->routesAreCached()) {
            Passport::routes();
        }

        Passport::tokensExpireIn(now()->addHours());
        Passport::refreshTokensExpireIn(now()->addDays(30));
    }
}
