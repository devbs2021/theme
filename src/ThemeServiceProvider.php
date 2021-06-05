<?php

namespace Devbs\Theme;

use Devbs\Theme\Facades\Theme;
use Devbs\Theme\Middleware\CheckStatus;
use Illuminate\Routing\Router;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'theme');
        $this->publishes([
            __DIR__ . '/public' => public_path('theme'),
        ], 'public');
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('checkstatus', CheckStatus::class);

    }
    public function register()
    {
        $this->app->bind('theme', function () {
            return new Theme;
        });
    }
}
