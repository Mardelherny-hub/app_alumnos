<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Definir el nombre de la tabla si no sigue la convención
    protected $table = 'usuarios';

    // Desactivar timestamps si no están en la tabla
    public $timestamps = false;

    // Definir los campos que Laravel puede rellenar
    protected $fillable = [
        'usuario', 'pass', 'nombre', 'apellido', 'nivel',
    ];

    // Definir el campo que se usará para la autenticación (usuario en vez de email)
    public function getAuthIdentifierName()
    {
        return 'usuario';
    }

    // Definir el campo de contraseña personalizado
    public function getAuthPassword()
    {
        return $this->pass;
    }
}
