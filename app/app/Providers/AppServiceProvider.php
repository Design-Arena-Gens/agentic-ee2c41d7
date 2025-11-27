<?php

namespace App\Providers;

use App\Services\BrandManager;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(BrandManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (! Schema::hasTable('brands')) {
                return;
            }

            $brandManager = app(BrandManager::class);

            $view->with('brandManager', $brandManager);
            $view->with('currentBrand', $brandManager->current());
            $view->with('availableBrands', $brandManager->all());
        });
    }
}
