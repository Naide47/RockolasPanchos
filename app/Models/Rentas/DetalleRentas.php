<?php

namespace App\Models\Rentas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleRentas extends Model
{
    protected $table = 'detalle_renta';

    use HasFactory;

    protected $fillable = ["renta_id", "producto_id", "cantidad", "precioUnitario"];
}
