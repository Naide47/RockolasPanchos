<?php

namespace App\Http\Controllers\Rentas;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Persona\PersonaController;
use App\Models\Rentas\Rentas;
use App\Models\Rentas\DetalleRentas;

use App\Models\Usuarios\Clientes;
use App\Models\Productos\Producto;
use App\Models\Productos\Paquete;
use App\Models\Productos\DetallePaquete;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class rentaController extends Controller
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
        return view('renta.view', compact('paquete', 'table', 'productos'), compact('detallePaquete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->id) {
            $modelo = Paquete::find($request->id);
        }

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

        return view('renta.create', compact('modelo', 'mPaquetes'));
        #return $mPaquetes;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            "rtotal" => "required",
            "anticipo" => "required",
            "fechaInicio" => "required",
            "fechaTermino" => "required",
            "nombre" => "required",
            "colonia" => "required",
            "codigoPostal" => "required",
            "calle" => "required",
            "telefono" => "required",
            "celular" => "required",
        ]);

        DB::beginTransaction();

        try {

            $mRenta = new Rentas();

            $mRenta->total = $request->rtotal;
            $mRenta->anticipoPagado = $request->anticipo;
            $mRenta->fechaInicio = $request->fechaInicio;
            $mRenta->fechaTermino = $request->fechaTermino;
            $mRenta->fechaRegistro = now();

            $personaController = new  PersonaController();
            $idPersona = $personaController->store($request);

            $mCliente = new Clientes;
            $mCliente->persona_id = $idPersona;
            $mCliente->save();

            $mRenta->user_id = 1;
            $mRenta->cliente_id = $mCliente->id;
            $mRenta->estatus = 1;

            $mRenta->save();

            $mDetallePaquete = DB::table('detalle_paquete')
                ->select('producto_id', 'precioUnitario', 'cantidad')
                ->where('detalle_paquete.paquete_id', '=', $request->paquete_id)
                ->get();

            foreach ($mDetallePaquete as $mDetalle){

                $mDetalleRenta = new DetalleRentas();
            
                $mDetalleRenta->renta_id = $mRenta->id;
    
                $mDetalleRenta->producto_id = $mDetalle->producto_id;            
                $mDetalleRenta->precioUnitario = $mDetalle->precioUnitario;
                $mDetalleRenta->cantidad = $mDetalle->cantidad;
             
                $mDetalleRenta->save();
                
            }

            DB::commit();

            Session::flash('message', 'Renta Registrada!');
            Session::flash('alert-class', 'success');

            return redirect('renta');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }


        // Mensaje Flash (una vez que se elimina la variable)
        return Redirect::to('renta');

        echo "Correcto";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
