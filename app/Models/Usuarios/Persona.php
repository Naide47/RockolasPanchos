<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;

class Persona extends Model
{
    public $timestamps = false;

    protected $table = "persona";

    protected $fillable = [
        "nombre",
        "colonia",
        "calle",
        "codigoPostal",
        "telefono",
        "celular"
    ];
    
    public function clientes()
    {
        return $this->hasMany('Cliente', 'persona_id');
    }
}
