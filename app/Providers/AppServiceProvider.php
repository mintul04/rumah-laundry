<?php

namespace App\Providers;

use App\Models\Pengaturan;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
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
        // Pastikan locale Laravel ke Indonesia
        App::setLocale('id');

        // Atur locale Carbon global
        Carbon::setLocale('id');

        //landing-page
        View::composer(['layouts.main', 'frontend.landing-page'], function ($view) {
            $pengaturan = Pengaturan::first();
            $view->with('pengaturan', $pengaturan);
        });

        //auth.login
        View::composer(['layouts.main', 'auth.login'], function ($view) {
            $pengaturan = Pengaturan::first();
            $view->with('pengaturan', $pengaturan);
        });
    }
}
