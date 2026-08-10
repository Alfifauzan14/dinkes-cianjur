<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\SettingFooter;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFour();

        // Share site-wide settings with all views
        View::composer('*', function (\Illuminate\View\View $view): void {
            try {
                if (Schema::hasTable('settings')) {
                    $siteSettings = Setting::all()->pluck('value', 'key')->toArray();
                    $site_settings = SettingFooter::first();
                } else {
                    $siteSettings = [];
                    $site_settings = null;
                }
            } catch (\Exception $e) {
                $siteSettings = [];
                $site_settings = null;
            }
            $view->with('siteSettings', $siteSettings);
            $view->with('site_settings', $site_settings);
        });
    }
}
