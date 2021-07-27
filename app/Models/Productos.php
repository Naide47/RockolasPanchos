<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'producto';

    use HasFactory;

    protected $fillable = ["idCategoria", "nombre", "existencias", "disponibles", "precioCompra", "precioUnitario", "rutaFoto"];
}
