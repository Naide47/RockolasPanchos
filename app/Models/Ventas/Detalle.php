<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ventas\Venta;

class DetalleVentaEloquent extends Model
{
    use HasFactory;

    protected $table = 'detalle_venta';

    public function ventas()
    {
        return $this->belongsTo('Venta', 'venta_id');
    }

}
