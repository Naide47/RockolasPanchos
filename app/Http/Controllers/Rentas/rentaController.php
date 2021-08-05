<?php

namespace App\Http\Controllers\Rentas;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Rentas\Rentas;
use App\Models\Usuarios\Persona;
use App\Models\Usuarios\Rol;
use App\Models\Usuarios\Clientes;
use App\Models\Usuarios\Usuario;

use App\Models\Rentas\DetalleRentas;
use App\Models\Productos\Categoria;
use App\Models\Productos\Producto;

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
        //$table = Producto::all();
        return view('renta.view', compact('table'));
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

        $clientes = Rol::all();
        $personas = Persona::all();
        $usuarios = Usuario::all();
        $categorias = Categoria::all();
        #$productos = Producto::all();
        $clientes = Clientes::all();

        return view('renta.create', compact('clientes',  'personas', 'usuarios'), compact('categorias', 'modelo'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $mRenta = new Rentas();
        $mDetalleRenta = new DetalleRentas();

        $mRenta->total = $request->total;
        $mRenta->anticipoPagado = $request->anticipoPagado;
        $mRenta->fechaInicio = $request->fechaInicio;
        $mRenta->fechaTermino = $request->fechaTermino;
        $mRenta->fechaRegistro = now();
        $mRenta->noTarjeta = $request->noTarjeta;
        $mRenta->tipoTarjeta = $request->tipoTarjeta;

        $mRenta->user_id = $request->usuario;
        $mRenta->cliente_id = $request->cliente;
        $mRenta->estatus = 1;

        $mDetalleRenta->producto_id = $request->producto_id;
        $mDetalleRenta->renta_id = $request->renta_id;
        $mDetalleRenta->precioUnitario = $request->precioUnitario;
        $mDetalleRenta->cantidad = $request->cantidad;

        $mRenta->save();
        
        // Mensaje Flash (una vez que se elimina la variable)
        Session::flash('message', 'Renta Registrada!');
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
