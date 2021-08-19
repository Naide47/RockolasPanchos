<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos\Producto;
use App\Models\Ventas\Devolucion;
use App\Models\Ventas\Venta;

use App\Http\Controllers\PDFController;

use Redirect;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;



class DevolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = Producto::all();
        return view('devoluciones.index', compact('table'));
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
        $validateData = $request->validate([
            'identificador' => 'required',
            'nombre' => 'required|min:3|max:140',
            'celular' => 'required|min:3|max:15',
            'producto' => 'required',
            'cantidad' => 'required',
            'descripcion' => 'required|min:3',
            
        ]);        

        DB::beginTransaction();
        try {

            $mVenta = Venta::where('identificador', $request->identificador)->first();
            if(!$mVenta){
                DB::rollBack();
                Session::flash('message', 'No se encontro la venta');
               
                return redirect('devoluciones');
            }

            $mDevolucion = new Devolucion();
            $mDevolucion->venta_identificador = $request->identificador;
            $mDevolucion->cliente = $request->nombre;
            $mDevolucion->celular = $request->celular;
            $mDevolucion->producto = $request->producto;
            $mDevolucion->cantidad = $request->cantidad;
            $mDevolucion->descripcion = $request->descripcion;
            $mDevolucion->save();

            DB::commit();
            $pdfController = new PDFController();
            $pdfController->createPDFDevolucion($mDevolucion->id);
            // Session::flash('message', '"' . $row['nombre'] . '" ya esta en el carrito ');
            // return redirect('devoluciones');

        } catch (\Exception $e) {
            DB::rollBack();
            // Session::flash('message', '"' . $row['nombre'] . '" ya esta en el carrito ');
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

    public function mostrar(){
        $mDevolucion = Devolucion::all();

        return view('devoluciones.mostrar', compact('mDevolucion'));
    }

}
