<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        RateLimiter::for(
            name: 'api',
            callback: static function (Request $request) {
                return Limit::perMinute(
                    maxAttempts: 60
                )->by(
                    key: \strval($request->user()?->id ?: $request->ip())
                );
            }
        );

        $this->routes(function () {
            Route::middleware('api')->group(
                base_path('routes/api/routes.php')
            );
        });
    }
}
