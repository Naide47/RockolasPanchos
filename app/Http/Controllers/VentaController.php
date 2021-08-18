<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos\Producto;
use App\Models\Ventas\Detalle;
use App\Models\Ventas\Venta;
use App\Models\Ventas\Cliente;
use App\Models\Usuarios\Persona;
use App\Models\Usuarios\Usuario;
use Redirect;

use App\Http\Controllers\Persona\PersonaController;
use App\Http\Controllers\Productos\ProductoController;
use App\Http\Controllers\PDFController;

use Illuminate\Support\Facades\Session;

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
        // return session()->all();
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
        if($request){
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
        
        $validateData = $request->validate([
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
            'total' => 'required|min:1|max:30'
            
        ]);        

        DB::beginTransaction();
        try {

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
            // $mVenta->noTarjeta = $request->numTarjeta;
            // $mVenta->tipoTarjeta = $request->tipoTarjeta;
            // $mVenta->identificador = '0';
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
            $existenciasF = $producto->existencias - $request->input($request->cantidad);
            $disponiblesF = $producto->disponibles - $request->input($request->cantidad);

            $producto->existencias = $existenciasF;
            $producto->disponibles = $disponiblesF;
            $producto->save();

            DB::commit();
            $pdfController = new PDFController();
            $pdfController->createPDFVentas($mCliente->id, $mCliente->persona_id, $mVenta->id, $mDetalle->id, $mDetalle->producto_id);
            // Session::flash('message','Venta realizada');
            // return redirect('ventas');
            // return "Si";

        } catch (\Exception $e) {
            DB::rollBack();
            // Session::flash('message', $e->getMessage());
            // Session::flash('alert-class', 'danger');
            // return redirect('usuarios.create');
            // return "No";
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
        $mVenta = Venta::where('venta.id', $id)
            ->join('cliente', 'venta.cliente_id', '=', 'cliente.id')
            ->select(
                'venta.id',
                'venta.users_id',
                'venta.total',
                'venta.anticipoPagado',
                'venta.fechaRegistro',
                'venta.identificador',
                'venta.status',
                'cliente.persona_id'
            )->first();
        
        $mPersona = Persona::where('id', $mVenta->persona_id)->first();    

        $mDetalle = Detalle::where('detalle_venta.venta_id', $id)
            ->join('producto', 'detalle_venta.producto_id', '=', 'producto.id')
            ->select(
                'detalle_venta.cantidad',
                'detalle_venta.precioUnitario',
                'producto.nombre',
                'producto.imgNombreFisico'
            )->get();

        $mUsuario = Usuario::find($mVenta->users_id);

        return view('ventas.show', compact('mVenta', 'mPersona', 'mDetalle', 'mUsuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "Edit";
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
        return "destroy";
    }

    public function mostrar(){
        $mVentas = DB::table('venta')
            ->join('cliente', 'venta.cliente_id', '=', 'cliente.id')
            ->join('persona', 'cliente.persona_id', '=', 'persona.id')
            ->select(
                'venta.id',
                'persona.nombre',
                'venta.total',
                'venta.anticipoPagado',
                'venta.identificador',
                'venta.status'
            )->get();
        // $mClientes = Cliente::all();
        // $mPersonas = Persona::all();

        return view('ventas.mostrar', compact('mVentas'));
    }

    public function enproceso(){
        $mVentas = DB::table('venta')
            ->join('cliente', 'venta.cliente_id', '=', 'cliente.id')
            ->join('persona', 'cliente.persona_id', '=', 'persona.id')
            ->select(
                'venta.id',
                'persona.nombre',
                'venta.total',
                'venta.anticipoPagado',
                'venta.identificador',
                'venta.status'
            )->get();
        // $mClientes = Cliente::all();
        // $mPersonas = Persona::all();
        
        return view('ventas.mostrarenproceso', compact('mVentas'));
    }

    public function completas(){
        $mVentas = DB::table('venta')
            ->join('cliente', 'venta.cliente_id', '=', 'cliente.id')
            ->join('persona', 'cliente.persona_id', '=', 'persona.id')
            ->select(
                'venta.id',
                'persona.nombre',
                'venta.total',
                'venta.anticipoPagado',
                'venta.identificador',
                'venta.status'
            )->get();
        // $mClientes = Cliente::all();
        // $mPersonas = Persona::all();
        
        return view('ventas.mostrarcompletadas', compact('mVentas'));
    }

    public function tomar(Request $request){
        $mVenta = Venta::find($request->id);
        $mVenta->users_id = $request->idUsuario;
        $mVenta->status = 2;
        $mVenta->save();

        return redirect('ventas/mostrar');
    }

    public function completar(Request $request){
        $mVenta = Venta::find($request->id);
        $mVenta->users_id = $request->idUsuario;
        $mVenta->status = 3;
        $mVenta->save();

        return redirect('ventas/mostrar');
    }

    public function showCarrito()
    {
        // echo var_dump(session()->get('carrito'));
        return view('ventas.carrito');
    }

    public function agregarCarrito(Request $request)
    {

        // session()->forget('carrito');
        // echo var_dump(session()->has('carrito'));

        $carrito = $request->session()->get('carrito');
        if (!$carrito) {
            $carrito = [];
        }

        foreach ($carrito as $row) {
            if ($row['IdProducto'] == $request->IdProducto) {
                Session::flash('message', '"' . $row['nombre'] . '" ya esta en el carrito ');
                return redirect('ventas');
            }
        }
        
        array_push($carrito, [
            'IdProducto' => $request->IdProducto,
            'cantidad' => $request->cantidad,
            'nombre' => $request->nombreProducto,
            'imagen' => $request->imagen,
            'precio' => $request->precioUnitario
        ]);

        $request->session()->put('carrito', $carrito);
        #echo var_dump($carrito);
        // foreach($carrito as $row){
        //     echo ($row['nombre']);
        // }
        //echo ('Son iguales');
        return redirect()->route('mostrarCarrito');

        // return view('ventas.carrito', compact('carrito'));
    }


    public function elimnarItemCarrito(Request $request)
    {
        $carrito = $request->session()->get('carrito');
        $idP = $request->idP;
        $idP = $idP - 1;
        array_splice($carrito, $idP, 1);
        // $request->session()->forget('carrito');
        $request->session()->put('carrito', $carrito);
        if($idP < 0) {
            $request->session()->forget('carrito');
        }
        // echo ($idP);
        // echo var_dump($carrito);
        // return view('ventas.carrito', compact('carrito'));
        return redirect()->route('mostrarCarrito');
    }

    public function compras(Request $request)
    {
        // $request->session()->forget('detalle');
        $carrito = $request->session()->get('carrito');
        // return $request->only('idP1','cantidad1','nombre1','imagen1','precio1');
        if (!$carrito) {
            return redirect()->route('mostrarCarrito');
        }

        $nuevoCarrito = [];
        
        for ($i=0; $i < count($carrito); $i++) {
            $idP = 'idP'.($i+1);
            $cantidad = 'cantidad'.($i+1);
            $nombre = 'nombre'.($i+1);
            $imagen = 'imagen'.($i+1);
            $precio = 'precio'.($i+1);
            // $producto = $request->only($idP, $cantidad, $nombre, $imagen, $precio);
            // $arreglo = []
            $producto = ['idP'=>$request->input($idP),
                         'cantidad'=>$request->input($cantidad),
                         'nombre'=>$request->input($nombre),   
                         'imagen'=>$request->input($imagen),   
                         'precio'=>$request->input($precio)  
                        ];
                array_push($nuevoCarrito, [
                    'IdProducto' => $producto['idP'],
                    'cantidad' => $producto['cantidad'],
                    'nombre' => $producto['nombre'],
                    'imagen' => $producto['imagen'],
                    'precio' => $producto['precio']
                ]);
                $request->session()->put('nuevoCarrito', $nuevoCarrito);
            
        }
        
        // return $nuevoCarrito;
        $anticipo = $request->anticipoCarritoEnviar;
        $total = $request->totalFinalEnviar;
        
        return view('ventas.compra', compact('anticipo', 'total'));
    }

    public function guardarCompra(Request $request)
    {
        $validateData = $request->validate([
            'nombre' => 'required|min:3|max:30',
            'apellido' => 'required|min:3|max:30',
            'calle' => 'required|min:3|max:30',
            'colonia' => 'required|min:3|max:30',
            'codigoPostal' => 'required|min:3|max:9',
            'telefono' => 'required|min:3|max:15',
            'celular' => 'required|min:3|max:15'
        ]);

        $carrito = $request->session()->get('nuevoCarrito');

        DB::beginTransaction();
        try {

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
                $mVenta->total = $request->totalCompra;
                $mVenta->anticipoPagado = $request->anticipoCompra;
                $mVenta->status = 1;
                $mVenta->save();

            for($i=0; $i < count($carrito); $i++){
                $idP = 'idPCompra'.($i+1);
                $cantidad = 'cantidadCompra'.($i+1);
                $precio = 'precioCompra'.($i+1);

                $mDetalle = new Detalle();
                $mDetalle->venta_id = $mVenta->id;
                $mDetalle->producto_id = $request->input($idP);
                $mDetalle->cantidad = $request->input($cantidad);
                $mDetalle->precioUnitario = $request->input($precio);
                $mDetalle->save();

                $producto = Producto::find($request->input($idP));
                $existenciasF = $producto->existencias - $request->input($cantidad);
                $disponiblesF = $producto->disponibles - $request->input($cantidad);

                $producto->existencias = $existenciasF;
                $producto->disponibles = $disponiblesF;
                $producto->save();

            }

            DB::commit();
            $pdfController = new PDFController;
            $pdfController->createPDFVentasCompra($mCliente->id, $mCliente->persona_id);
            Session::flash('message','Venta realizada');
            // return Redirect::to('ventas');
            return redirect('ventas');

        } catch (\Exception $e) {
            DB::rollBack();
            // Session::flash('message', $e->getMessage());
            // Session::flash('alert-class', 'danger');
            // return redirect('usuarios.create');
            return $e->getMessage();
        }
    }

    public function mostrarCompra(){
        $mPersonas = Persona::all();
        $mClientes = Cliente::all();
        $mVentas = Venta::all();
        $mDetalles = Detalle::all();
        $mProductos = Producto::all();

        return view('ventas.mostrarVentas', compact('mProductos','mPersonas','mClientes','mVentas','mDetalles'));
    }


}
