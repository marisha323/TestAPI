<?php

namespace App\Providers;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
