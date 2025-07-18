<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CorsMiddleware; 

class RouteServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
  
        Route::middleware([
            'api',
            CorsMiddleware::class])
            ->prefix('api')
            ->group(base_path('routes/api.php'));

        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }
}
