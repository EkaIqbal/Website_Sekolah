<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View; // ← Tambahkan baris ini!
use App\Models\SosialMedia;          // ← Dan pastikan modelnya benar

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
        if (Schema::hasTable('sosial_media')) {
            View::share('sosials', SosialMedia::all());
        }
    }
}