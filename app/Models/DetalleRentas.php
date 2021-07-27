<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleRentas extends Model
{
    protected $table = 'detalle_renta';

    use HasFactory;

    protected $fillable = ["idRenta", "idProducto", "cantidad", "precioUnitario"];
}
