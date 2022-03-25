<?php

namespace App\Providers;

use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Policies\BasketPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        BasketController::class => BasketPolicy::class,
        ProductController::class => ProductPolicy::class,
        CategoryController::class => CategoryPolicy::class,
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
