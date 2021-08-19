<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use App\Models\Productos\DetallePaquete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetallePaqueteController extends Controller
{

    public function store($paquete_id, $producto_id, $cantidad)
    {
        $mDetallePaquete = new DetallePaquete();
        $mDetallePaquete->paquete_id = $paquete_id;
        $mDetallePaquete->producto_id = $producto_id;
        $mDetallePaquete->cantidad = $cantidad;
        $mDetallePaquete->save();
    }
}
