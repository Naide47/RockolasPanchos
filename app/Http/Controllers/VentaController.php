<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos\Producto;
use App\Models\Ventas\Detalle;
use App\Models\Ventas\Venta;
use App\Models\Ventas\Cliente;
use App\Models\Usuarios\Persona;
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
        return "show";
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

            for($i=0; $i < count($carrito); $i++){
                $idP = 'idPCompra'.($i+1);
                $cantidad = 'cantidadCompra'.($i+1);
                $precio = 'precioCompra'.($i+1);

                $mVenta = new Venta();
                $mVenta->cliente_id = $mCliente->id;
                $mVenta->users_id = 1;
                $mVenta->total = $request->totalCompra;
                $mVenta->anticipoPagado = $request->anticipoCompra;
                // $mVenta->noTarjeta = 0;
                // $mVenta->tipoTarjeta = 0;
                $mVenta->status = 1;
                $mVenta->save();

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
            return Redirect::to('ventas');

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
