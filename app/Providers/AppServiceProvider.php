<?php

namespace App\Providers;

use App\Contracts\AuthContract;
use App\Repositories\AuthRepository;
use Illuminate\Support\ServiceProvider;
use App\Contracts\LinkContract;
use App\Repositories\LinkRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(LinkContract::class, LinkRepository::class);
        $this->app->bind(AuthContract::class, AuthRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
