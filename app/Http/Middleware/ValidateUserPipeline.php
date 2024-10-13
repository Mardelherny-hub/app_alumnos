<?php

namespace App\Http\Middleware;

use Closure;

class ValidateUserPipeline
{
    public function handle($request, Closure $next)
    {
        // Validar si el usuario existe
        $user = \App\Models\User::where('usuario', $request->usuario)->first();

        if (!$user) {
            return back()->withErrors(['usuario' => 'Usuario no encontrado.']);
        }

        // Validar la contraseña
        if (!password_verify($request->pass, $user->pass)) {
            return back()->withErrors(['pass' => 'Contraseña incorrecta.']);
        }

        // Pasar al siguiente middleware si todo está bien
        return $next($request);
    }
}
