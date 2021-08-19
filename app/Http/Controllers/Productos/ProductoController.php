<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PDFProductos;
use App\Models\Productos\Categoria;
use Illuminate\Http\Request;
use App\Models\Productos\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mProductos = Producto::all();
        return view('productos.index', compact('mProductos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $mCategorias = Categoria::all()->sortBy("id");
        return view('productos.create', compact('mCategorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:producto,nombre',
            'categoria' => 'required',
            'cantidad' => 'required|integer|gte:0',
            'precioCompra' => 'required|numeric|gte:0',
            'precioUnitario' => 'required|numeric|gte:0',
            'imagen' => 'image|mimes:png,jpg,jpeg',
        ]);

        $mProducto = new Producto();
        $mProducto->categoria_id = $request->categoria;
        $mProducto->nombre = $request->nombre;
        $mProducto->existencias = $request->cantidad;
        $mProducto->disponibles = $request->cantidad;
        $mProducto->precioCompra = $request->precioCompra;
        $mProducto->precioUnitario = $request->precioUnitario;
        $mProducto->save();

        $file = $request->file('imagen');
        if ($file) {
            $fileName = strtok($file->getClientOriginalName(), ".jpg"); //Nombre sin extensión
            $imgNombreVirtual = $file->getClientOriginalName();
            $imgNombreFisico = $mProducto->id . "_" . $fileName . "_producto" . "." . $file->getClientOriginalExtension();
            Storage::disk('local')->put($imgNombreFisico, File::get($file));
            $mProducto->imgNombreVirtual = $imgNombreVirtual;
            $mProducto->imgNombreFisico = $imgNombreFisico;
            $mProducto->save();
        }

        Session::flash('message', 'Producto agregado con exito');
        Session::flash('alert-class', 'success');
        return redirect('productos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mProducto = DB::table('producto')
            ->join('categoria', 'producto.categoria_id', '=', 'categoria.id')
            ->select(
                'producto.nombre',
                'producto.existencias',
                'producto.disponibles',
                'producto.precioCompra',
                'producto.precioUnitario',
                'producto.imgNombreFisico',
                'categoria.categoria'
            )
            ->where('producto.id', '=', $id)
            ->first();

        return view('productos.show', compact('mProducto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mProducto = Producto::find($id);
        $mCategorias = Categoria::all()->sortBy("id");
        return view('productos.edit', compact('mProducto', 'mCategorias'));
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
        $request->validate([
            'nombre' => 'required|unique:producto,nombre, ' . $id,
            'existencias' => 'required|integer|gte:0|gte:disponibles',
            'disponibles' => 'required|integer|gte:0|lte:existencias',
            'precioCompra' => 'required|numeric|gte:0',
            'precioUnitario' => 'required|numeric|gte:0',
            'imagen' => 'image|mimes:png,jpg,jpeg'

        ]);

        $mProducto = Producto::find($id);
        $mProducto->nombre = $request->nombre;
        $mProducto->categoria_id = $request->categoria;
        $mProducto->existencias = $request->existencias;
        $mProducto->disponibles = $request->disponibles;
        $mProducto->precioCompra = $request->precioCompra;
        $mProducto->precioUnitario = $request->precioUnitario;

        $file = $request->file('imagen');
        if ($file) {
            $imgFisicoOriginal = $mProducto->imgNombreFisico;
            Storage::delete($imgFisicoOriginal);

            $fileName = strtok($file->getClientOriginalName(), ".jpg"); //Nombre sin extensión
            $imgNombreVirtual = $file->getClientOriginalName();
            $imgNombreFisico = $mProducto->id . "_" . $fileName . "_paquete" . "." . $file->getClientOriginalExtension();
            Storage::disk('local')->put($imgNombreFisico, File::get($file));
            $mProducto->imgNombreVirtual = $imgNombreVirtual;
            $mProducto->imgNombreFisico = $imgNombreFisico;
        }

        $mProducto->save();

        Session::flash('message', 'Producto actualizado con exito');
        Session::flash('alert-class', 'success');

        return redirect('productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
    public function destroy($id)
    {
        //
    }
     */

    public function generarReporte()
    {
        $pdf = new PDFController();

        $mProductos = DB::table('producto')
            ->join("categoria", "categoria.id", "=", "producto.categoria_id")
            ->select(
                "producto.*",
                "categoria.categoria as categoria"
            )
            ->orderBy("id")
            ->get();

        // return $mProductos;

        $pdf->crearPDFProductos($mProductos);
    }
}
