<?php

namespace App\Providers;

use App\Models\Dosen;
use App\Models\Tendik;
use App\Models\Mahasiswa;
use App\Observers\DosenObserver;
use App\Observers\TendikObserver;
use App\Observers\MahasiswaObserver;
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
        // Mahasiswa::observe(MahasiswaObserver::class);
        // Dosen::observe(DosenObserver::class);
        // Tendik::observe(TendikObserver::class);
    }
}
