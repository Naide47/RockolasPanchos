<?php

namespace App\Models\Rentas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentas extends Model
{
    protected $table = 'renta';

    use HasFactory;

    protected $fillable = ["cliente_id", "usuario_id", "total", "fechaRegistro", "fechaInicio", "fechaTermino", "calle", "colonia", "noexterior"];
}
