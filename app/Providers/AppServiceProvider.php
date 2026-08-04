<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (!app()->runningInConsole()) {
                view()->share('site_settings', \App\Models\SettingFooter::first());
            }
        } catch (\Exception $e) {
            // Silence exception if DB is not migrated yet during installation
        }
    }
}
