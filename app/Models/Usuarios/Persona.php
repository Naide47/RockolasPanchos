<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $timestamps = false;

    protected $table = "personas";

    protected $fillable = [
        "nombre",
        "colonia",
        "calle",
        "codigoPostal",
        "telefono",
        "celular"
    ];
}
