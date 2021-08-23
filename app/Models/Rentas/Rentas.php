<?php

namespace App\Models\Rentas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentas extends Model
{
    protected $table = 'renta';

    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = ["cliente_id", "usuario_id", "total", "fechaRegistro", "fechaInicio", "fechaTermino", "estatus"];
}
