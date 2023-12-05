<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar que el usuario esté autenticado
        if (auth()->check()) {
            // Verificar si el usuario tiene el rol de administrador
            if (auth()->user()->rol === 'admin') {
                // Permitir acceso a usuarios autenticados con rol de administrador
                return $next($request);
            }

            // Si no tiene el rol de administrador, redirigir a la página de inicio
            return redirect(route('inicio'))->with('warning', 'Acceso denegado: Se requiere rol de administrador.');
        }

        // Redirigir al usuario no autenticado a la página de inicio de sesión
        return redirect(route('login'))->with('warning', 'Acceso denegado: Debes iniciar sesión.');
    }
}
