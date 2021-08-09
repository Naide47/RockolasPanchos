<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos\Producto;
use App\Models\Ventas\Detalle;
use App\Models\Ventas\Venta;
use App\Models\Ventas\Cliente;
use App\Models\Usuarios\Persona;

use App\Http\Controllers\Persona\PersonaController;
use App\Http\Controllers\Productos\ProductoController;
use App\Http\Controllers\PDFController;
use Session;
use Redirect;

use Illuminate\Support\Facades\DB;

date_default_timezone_set('UTC');
#use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = Producto::all();
        return view('ventas.index', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->id){
            $modelo = Producto::find($request->id);
        }
        return view('ventas.create', compact('modelo'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request -> validate([
            'nombre' => 'required|min:3|max:30',
            'apellido' => 'required|min:3|max:30',
            'calle' => 'required|min:3|max:30',
            'colonia' => 'required|min:3|max:30',
            'codigoPostal' => 'required|min:3|max:9',
            'telefono' => 'required|min:3|max:15',
            'celular' => 'required|min:3|max:15',
            'id' => 'required',
            'existencias' => 'required',
            'disponibles' => 'required',
            'cantidad' => 'required',
            'nombre_producto' => 'required|min:3|max:150',
            'precio' => 'required|min:1|max:30',
            'anticipo' => 'required|min:1|max:30',
            'total' => 'required|min:1|max:30',
            'numTarjeta' => 'required',
            'tipoTarjeta' => 'required'
        ]);

        DB::beginTransaction();
        try{

            $nombreCompleto = $request->nombre . " " . $request->apellido;

            $personaController = new  PersonaController();
            $request->nombre = $nombreCompleto;
            $idPersona = $personaController->store($request);

            $mCliente = new Cliente();
            $mCliente->persona_id = $idPersona;
            $mCliente->save();
            
            $mVenta = new Venta();
            $mVenta->cliente_id = $mCliente->id;
            $mVenta->users_id = 1;
            $mVenta->total = $request->total;
            $mVenta->anticipoPagado = $request->anticipo;
            $mVenta->noTarjeta = $request->numTarjeta;
            $mVenta->tipoTarjeta = $request->tipoTarjeta;
            $mVenta->status = 1;
            $mVenta->save();
            
            #$venta_id = Venta::all();

            $mDetalle = new Detalle();
            $mDetalle->venta_id = $mVenta->id;
            $mDetalle->producto_id = $request->id;
            $mDetalle->cantidad = $request->cantidad;
            $mDetalle->precioUnitario = $request->precio;
            $mDetalle->save();

            $producto = Producto::find($request->id);
            $existenciasF = $request->existencias - $request->cantidad;
            $disponiblesF = $request->disponibles - $request->cantidad;

            $producto->existencias = $existenciasF;
            $producto->disponibles = $disponiblesF;
            $producto->save();

            DB::commit();
            $pdfController = new PDFController;
            $pdfController->createPDFVentas($mCliente->id, $mCliente->persona_id, $mVenta->id, $mDetalle->id, $mDetalle->producto_id);
            #Session::flash('message','Venta realizada');
            #return Redirect::to('ventas');

        } catch (\Exception $e) {
            DB::rollBack();
            // Session::flash('message', $e->getMessage());
            // Session::flash('alert-class', 'danger');
            // return redirect('usuarios.create');
            return $e->getMessage();
        }
        
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

    public function agregarCarrito(Request $request){

        // session()->forget('carrito');
        // echo var_dump(session()->has('carrito'));

        $carrito = $request->session()->get('carrito');
        foreach($carrito as $row){
            if($row['IdProducto'] == $request->IdProducto){
                Session::flash('message','Ya esta en el carrito '.$row['nombre'] );
                return Redirect::to('ventas');
                
            }
        }
        if(!$carrito){
            $carrito=[];
        }

        array_push($carrito, [
            'IdProducto'=>$request->IdProducto,
            'cantidad'=>$request->cantidad,
            'nombre'=>$request->nombreProducto,
            'imagen'=>$request->imagen,
            'precio'=>$request->precioUnitario
        ]);
        
        $request->session()->put('carrito',$carrito);
        #echo var_dump($carrito);
        // foreach($carrito as $row){
        //     echo ($row['nombre']);
        // }
        //echo ('Son iguales');
        return view('ventas.carrito', compact('carrito'));
    }


    public function elimnarItemCarrito(Request $request){
        $carrito = $request->session()->get('carrito');
        $idP = $request->idP;
        unset($carrito[$idP]);
        #session()->forget('carrito');
        // if($idP < 1){
        //     $carrito = [];
        //     session()->forget('carrito');
        // }
        // echo ($idP);
        // echo var_dump($carrito);
        return view('ventas.carrito', compact('carrito'));
    }
}