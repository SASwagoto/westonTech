<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Site;

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
        $siteName = Site::value('app_title');
        config(['app.name' => $siteName]);
    }
}
