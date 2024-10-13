<?php

namespace App\Pipes;

use Closure;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class ValidateUserPipe
{
    /**
     * Create a new class instance.
     */

    public function handle($request, Closure $next)
    {
        // Buscar al usuario por usuario
        $user = User::where('usuario', $request['usuario'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'usuario' => 'El usuario con ese nombre no existe.'
            ]);
        }

        // Añadir el usuario al request para los siguientes pipes
        $request['user'] = $user;

        return $next($request); // Pasar al siguiente pipe
    }

}
