<?php

namespace App\Pipes;

use Closure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ValidatePasswordPipe
{
    public function handle($request, Closure $next)
    {
        $user = $request['user'];

        // Verificar si la contraseña es correcta
        if (!Hash::check($request['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => 'La contraseña es incorrecta.'
            ]);
        }

        return $next($request); // Todo está bien, seguir con el siguiente paso
    }
}
