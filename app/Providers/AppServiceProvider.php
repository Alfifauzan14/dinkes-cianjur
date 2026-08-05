<?php

namespace App\Providers;

use App\Models\Setting;
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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share site-wide settings with all views
        View::composer('*', function (\Illuminate\View\View $view): void {
            try {
                if (Schema::hasTable('settings')) {
                    $siteSettings = Setting::all()->pluck('value', 'key')->toArray();
                } else {
                    $siteSettings = [];
                }
            } catch (\Exception $e) {
                $siteSettings = [];
            }
            $view->with('siteSettings', $siteSettings);
        });
    }
}
