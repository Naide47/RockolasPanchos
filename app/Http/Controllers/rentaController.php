<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rentas;
use App\Models\Clientes;
use App\Models\Personas;
use App\Models\Usuarios;
use App\Models\DetalleRentas;
use App\Models\Categorias;
use App\Models\Productos;
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

        return view('renta.index', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Clientes::all();
        $personas = Personas::all();
        $usuarios = Usuarios::all();
        $categorias = Categorias::all();
        $productos = Productos::all();

        return view('renta.create', compact('clientes', 'personas', 'usuarios'), compact('categorias', 'productos'));
    
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

        $mRenta->idUsuario = $request->usuario;
        $mRenta->idCliente = $request->cliente;
        $mRenta->estatus = 1;



        $mRenta->save();
        
        // Mensaje Flash (una vez que se elimina la variable)
        Session::flash('message', 'Renta Registrado!');
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
