<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
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
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
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
            'nombre' => 'required',
            'categoria' => 'required',
            'existencias' => 'required',
            'precioCompra' => 'required'
        ]);

        $nuevoProducto = new Producto();
        $nuevoProducto->categoria_id = $request->categoria;
        $nuevoProducto->nombre = $request->nombre;
        $nuevoProducto->existencias = $request->existencias;
        $nuevoProducto->disponibles = $request->existencias;
        $nuevoProducto->precioCompra = $request->precioCompra;
        $precioUnitario = $request->precioCompra / $request->existencias;
        // $precioUnitario = ?
        $nuevoProducto->precioUnitario = $precioUnitario;
        $nuevoProducto->save();

        $file = $request->file('imagen');
        if ($file) {
            $imgNombreVirtual = $file->getClientOriginalName();
            $imgNombreFisico = "$nuevoProducto->idProducto_$imgNombreVirtual";
            Storage::disk('local')->put($imgNombreFisico, File::get($file));
            $nuevoProducto->imgNombreVirtual = $imgNombreVirtual;
            $nuevoProducto->imgNombreFisico = $imgNombreFisico;
            $nuevoProducto->save();
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
                // 'producto.id as producto_id',
                'producto.nombre',
                'producto.existencias',
                'producto.disponibles',
                'producto.precioCompra',
                'producto.precioUnitario',
                'producto.imgNombreFisico',
                // 'categoria.id as categoria_id',
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
        $producto = Producto::find($id);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
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
        $validacion = $request->validate([
            'nombre' => 'required',
            'existencias' => 'required',
            'precioCompra' => 'required',
            'precioUnitario' => 'required'
        ]);

        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->categoria_id = $request->categoria;
        $producto->existencias = $request->existencias;
        $producto->disponibles = $request->disponibles;
        $producto->precioCompra = $request->precioCompra;
        $producto->precioUnitario = $request->precioUnitario;

        $file = $request->file('imagen');
        if ($file) {
            $imgFisicoOriginal = $producto->imgNombreFisico;
            Storage::delete($imgFisicoOriginal);

            $imgNombreVirtual = $file->getClientOriginalName();
            $imgNombreFisico = "$producto->idProducto_$imgNombreVirtual";
            Storage::disk('local')->put($imgNombreFisico, File::get($file));
            $producto->imgNombreVirtual = $imgNombreVirtual;
            $producto->imgNombreFisico = $imgNombreFisico;
        }

        $producto->save();

        Session::flash('message', 'Producto actualizado con exito');
        Session::flash('alert-class', 'success');

        return redirect('productos');
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
