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
    public function storeSilla($silla, $sillaCantidad, $paquete_id)
    {
        $mDetallePaquete = new DetallePaquete();
        $mDetallePaquete->paquete_id = $paquete_id;
        $mDetallePaquete->producto_id = $silla;
        $mDetallePaquete->cantidad = $sillaCantidad;;
        $mDetallePaquete->save();
    }

    public function storeMesa($mesa, $mesaCantidad, $paquete_id)
    {
        $mDetallePaquete = new DetallePaquete();
        $mDetallePaquete->paquete_id = $paquete_id;
        $mDetallePaquete->producto_id = $mesa;
        $mDetallePaquete->cantidad = $mesaCantidad;
        $mDetallePaquete->save();
    }

    public function storeRockola($rockola, $rockolaCantidad, $paquete_id)
    {
        $mDetallePaquete = new DetallePaquete();
        $mDetallePaquete->paquete_id = $paquete_id;
        $mDetallePaquete->producto_id = $rockola;
        $mDetallePaquete->cantidad = $rockolaCantidad;
        $mDetallePaquete->save();
    }

    public function storeCarpa($carpa, $carpaCantidad, $paquete_id)
    {
        $mDetallePaquete = new DetallePaquete();
        $mDetallePaquete->paquete_id = $paquete_id;
        $mDetallePaquete->producto_id = $carpa;
        $mDetallePaquete->cantidad = $carpaCantidad;
        $mDetallePaquete->save();
    }

    public function storeInflable($inflable, $inflableCantidad, $paquete_id)
    {
        $mDetallePaquete = new DetallePaquete();
        $mDetallePaquete->paquete_id = $paquete_id;
        $mDetallePaquete->producto_id = $inflable;
        $mDetallePaquete->cantidad = $inflableCantidad;
        $mDetallePaquete->save();
    }
}
