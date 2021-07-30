<?php

namespace App\Models\Rentas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentas extends Model
{
    protected $table = 'renta';

    use HasFactory;

    protected $fillable = ["idCliente", "idUsuario", "total", "fechaRegistro", "fechaInicio", "fechaTermino"];
}
