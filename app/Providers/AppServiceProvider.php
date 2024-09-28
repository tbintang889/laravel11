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
    public function boot()
    {
        // ... kode lain ...
        $modules = glob(app_path('Modules/*'), GLOB_ONLYDIR);
        foreach ($modules as $module) {
            if (file_exists($module . '/routes.php')) {
                include $module . '/routes.php';
            }
            if (is_dir($module . '/Views')) {
                $this->loadViewsFrom($module . '/Views', basename($module));
            }
        }
    }
}
