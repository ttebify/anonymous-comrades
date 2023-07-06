<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force SSL if isSecure does not detect HTTPS
        if (config('app.url_force_https')) {
            URL::forceScheme('https');
        }
    }
}
