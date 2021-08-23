<?php

namespace App\Http\Controllers\Rentas;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Rentas\Rentas;
use App\Models\Rentas\DetalleRentas;

use App\Models\Usuarios\Clientes;
use App\Models\Productos\Producto;
use App\Models\Productos\Paquete;
use App\Http\Controllers\Persona\PersonaController;
use App\Models\Productos\DetallePaquete;
use App\Models\Usuarios\Persona;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RentaControllerUsuario extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Traemos los datos del ModelPolicy
        $table = Rentas::all();
        $paquete = Paquete::all();
        $detallePaquete = DetallePaquete::all();
        $productos = Producto::all();
        return view('renta.rentaUsuario.index', compact('paquete', 'table', 'productos'), compact('detallePaquete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mRenta = DB::table('detalle_renta')
            ->join('renta', 'detalle_renta.renta_id', '=', 'renta.id')
            ->join('detalle_paquete', 'detalle_paquete.producto_id', '=', 'detalle_renta.producto_id')
            ->join('cliente', 'cliente.id', '=', 'renta.cliente_id')
            ->join('persona', 'persona.id', '=', 'cliente.persona_id')
            ->join('paquete', 'paquete.id', '=', 'detalle_paquete.paquete_id')
            ->select(
                'renta.id',
                'renta.total',
                'renta.anticipoPagado',
                'renta.fechaInicio',
                'renta.fechaTermino',
                'renta.fechaRegistro',
                'renta.estatus',
                'persona.nombre',
                'persona.calle',
                'persona.colonia',
                'persona.codigopostal',
                'persona.celular',
                'detalle_renta.cantidad',
                'detalle_renta.producto_id',
                'detalle_renta.renta_id',
                'detalle_renta.precioUnitario',
                'paquete.imgNombreFisico',
                'paquete.imgNombreVirtual'
            )
            ->where('renta.id', '=', $id)
            ->first();

        $productos = Producto::all();
        $renta = Rentas::all();
        $detalleRenta = DetalleRentas::all();

        return view('renta.rentaUsuario.show', compact('mRenta', 'productos', 'renta', 'detalleRenta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $renta = Rentas::find($id);
        $mRenta = DB::table('detalle_renta')
            ->join('renta', 'detalle_renta.renta_id', '=', 'renta.id')
            ->join('detalle_paquete', 'detalle_paquete.producto_id', '=', 'detalle_renta.producto_id')
            ->join('cliente', 'cliente.id', '=', 'renta.cliente_id')
            ->join('persona', 'persona.id', '=', 'cliente.persona_id')
            ->join('paquete', 'paquete.id', '=', 'detalle_paquete.paquete_id')
            ->select(
                'renta.total',
                'renta.anticipoPagado',
                'renta.fechaInicio',
                'renta.fechaTermino',
                'renta.fechaRegistro',
                'renta.estatus',
                'renta.cliente_id',
                'persona.nombre',
                'persona.calle',
                'persona.colonia',
                'persona.codigopostal',
                'persona.celular',
                'persona.telefono',
                'detalle_renta.cantidad',
                'detalle_renta.producto_id',
                'detalle_renta.renta_id',
                'detalle_renta.precioUnitario',
                'paquete.imgNombreFisico',
                'paquete.imgNombreVirtual',
                'paquete.id'
            )
            ->where('renta.id', '=', $id)
            ->first();

        $mPaquetes = DB::table('detalle_paquete')
            ->join('producto', 'producto.id', '=', 'detalle_paquete.producto_id')
            ->select(
                'producto.id',
                'producto.nombre',
                'producto.precioUnitario',
                'detalle_paquete.cantidad'
            )
            ->where('detalle_paquete.paquete_id', '=', $request->id)
            ->get();

        $productos = Producto::all();
        $detalleRenta = DetalleRentas::all();
        $paquete = Paquete::all();

        return view('renta.rentaUsuario.edit', compact('mRenta', 'productos', 'renta', 'detalleRenta', 'mPaquetes', 'paquete'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $mRentaup = Rentas::find($id);

        $mRentaup->estatus = $request->estatus;

        $mRentaup->save();

        DB::commit();

        Session::flash('message', 'Renta Registrada!');
        Session::flash('alert-class', 'success');

        // Mensaje Flash (una vez que se elimina la variable)
        return Redirect::to('rentaUsuario');

        echo "Correcto";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
