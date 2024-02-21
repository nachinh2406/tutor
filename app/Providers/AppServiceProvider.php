<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Blade::directive('role', function ($middleware) {
            return "<?php if(\App\Http\Services\PermissionService::checkRole({$middleware})): ?>";
        });
        Blade::directive('endrole', function ($expression) {
            return "<?php endif; ?>";
        });
    }
}
