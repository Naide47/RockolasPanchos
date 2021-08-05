<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use App\Models\Productos\DetallePaquete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetallePaqueteController extends Controller
{
    public function storeSilla($silla, $sillaCantidad, $paquete_id)
    {
        $mDetallePaquete = new DetallePaquete();
        $mDetallePaquete->paquete_id = $paquete_id;
        $mDetallePaquete->producto_id = $silla;
        $mDetallePaquete->cantidad = $sillaCantidad;

        $precioUnitario = DB::table('producto')
            ->select("precioUnitario")
            ->where("id", "=", $silla)
            ->first();
        $precioUnitario = $precioUnitario->precioUnitario;
        
        $mDetallePaquete->precioUnitario = $precioUnitario;
        $mDetallePaquete->save();
    }

    public function storeMesa($mesa, $mesaCantidad, $paquete_id)
    {
        $mDetallePaquete = new DetallePaquete();
        $mDetallePaquete->paquete_id = $paquete_id;
        $mDetallePaquete->producto_id = $mesa;
        $mDetallePaquete->cantidad = $mesaCantidad;

        $precioUnitario = DB::table('producto')
            ->select("precioUnitario")
            ->where("id", "=", $mesa)
            ->first();
        $precioUnitario = $precioUnitario->precioUnitario;

        $mDetallePaquete->precioUnitario = $precioUnitario;
        $mDetallePaquete->save();
    }

    public function storeRockola($rockola, $rockolaCantidad, $paquete_id)
    {
        $mDetallePaquete = new DetallePaquete();
        $mDetallePaquete->paquete_id = $paquete_id;
        $mDetallePaquete->producto_id = $rockola;
        $mDetallePaquete->cantidad = $rockolaCantidad;

        $precioUnitario = DB::table('producto')
            ->select("precioUnitario")
            ->where("id", "=", $rockola)
            ->first();
        $precioUnitario = $precioUnitario->precioUnitario;

        $mDetallePaquete->precioUnitario = $precioUnitario;
        $mDetallePaquete->save();
    }

    public function storeCarpa($carpa, $carpaCantidad, $paquete_id)
    {
        $mDetallePaquete = new DetallePaquete();
        $mDetallePaquete->paquete_id = $paquete_id;
        $mDetallePaquete->producto_id = $carpa;
        $mDetallePaquete->cantidad = $carpaCantidad;

        $precioUnitario = DB::table('producto')
            ->select("precioUnitario")
            ->where("id", "=", $carpa)
            ->first();
        $precioUnitario = $precioUnitario->precioUnitario;

        $mDetallePaquete->precioUnitario = $precioUnitario;
        $mDetallePaquete->save();
    }

    public function storeInflable($inflable, $inflableCantidad, $paquete_id)
    {
        $mDetallePaquete = new DetallePaquete();
        $mDetallePaquete->paquete_id = $paquete_id;
        $mDetallePaquete->producto_id = $inflable;
        $mDetallePaquete->cantidad = $inflableCantidad;

        $precioUnitario = DB::table('producto')
            ->select("precioUnitario")
            ->where("id", "=", $inflable)
            ->first();
        $precioUnitario = $precioUnitario->precioUnitario;

        $mDetallePaquete->precioUnitario = $precioUnitario;
        $mDetallePaquete->save();
    }
}
