<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory; // 👈 Asegúrate de importar esto

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 👇 Registro del servicio Firebase para toda la app
        $this->app->singleton('firebase', function ($app) {
            return (new Factory)
                ->withServiceAccount(base_path('firebase/firebase_credentials.json'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Puedes dejar esto vacío por ahora
    }
}
