<?php

namespace App\Http\Controllers;

use App\Pipes\ValidateUserPipe;
use App\Pipes\ValidatePasswordPipe;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Definir las reglas básicas de validación de inputs
       // $request->validate([
       //     'usuario' => 'required|usuario',
       //     'password' => 'required'
       // ]);

        try {
            // Procesar las validaciones usando el pipeline
            app(Pipeline::class)
                ->send($request->only('usuario', 'password')) // Enviar el usuario y password
                ->through([
                    ValidateUserPipe::class,   // Validar si el usuario existe
                    ValidatePasswordPipe::class, // Validar si la contraseña es correcta
                ])
                ->thenReturn();

            // Si todo pasa, iniciar sesión al usuario (usando Auth)
            //auth()->login($request['user']);

            return route('dashboard');

        } catch (ValidationException $e) {
            // Retornar los errores de validación
            return view('login')->with('error');
        }
    }
}
