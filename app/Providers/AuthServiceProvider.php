<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Producto; // Asegúrate de importar el modelo Producto
use App\Policies\UserPolicy; // Asegúrate de importar la política de usuario correcta
use App\Policies\ProductoPolicy; // Asegúrate de importar la política de producto correcta
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class, // Utiliza la política de usuario correcta aquí
        Producto::class => ProductoPolicy::class, // Utiliza la política de producto correcta aquí
        // Otros modelos y políticas aquí...
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}