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
    public function boot(): void
    {
        // Variable global para el tema
        // app()->singleton('tema', function () {
        //     return 'adulto';
        // });
        // Livewire::setScriptRoute(function ($handle){
        //     return Route::get();
        // }
    }
}