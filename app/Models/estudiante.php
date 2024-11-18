<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class estudiante extends Model
{
    //
    protected $table = "estudiante";

    protected $fillable = [
         "nombre",
         'correo',
         'contrasena'
    ];
    protected $hidden = [
        'contrasena'
    ];
}
