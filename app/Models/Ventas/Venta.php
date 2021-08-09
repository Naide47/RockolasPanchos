<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ventas\Cliente;
use App\Models\Ventas\Detalle;

class Venta extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = "venta";

    public function clientes()
    {
        return $this->belongsTo('Cliente', 'cliente_id');
    }

    public function detalle_ventas()
    {
        return $this->hasMany('Detalle', 'venta_id');
    }

}
