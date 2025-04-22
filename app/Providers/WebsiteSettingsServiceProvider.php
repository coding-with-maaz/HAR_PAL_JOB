<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\WebsiteSetting;

class WebsiteSettingsServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('*', function ($view) {
            // Remove caching temporarily
            $settings = WebsiteSetting::first();
            $view->with('websiteSettings', $settings);
        });
    }
} 