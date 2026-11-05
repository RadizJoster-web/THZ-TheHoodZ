<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

/**
 * Service provider utama untuk bootstrap konfigurasi aplikasi.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Mendaftarkan service aplikasi.
     */
    public function register(): void
    {
        //
    }

    /**
     * Mempersiapkan service aplikasi dan pagination Bootstrap 5.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}

