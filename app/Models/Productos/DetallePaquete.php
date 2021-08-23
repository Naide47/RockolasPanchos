<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Model;

class DetallePaquete extends Model
{
    public $timestamps = false;
    
    protected $table = "detalle_paquete";

    protected $fillable = [
        'paquete_id',
        'producto_id',
        'cantidad',
        'PrecioUnitario'
    ];    
}
