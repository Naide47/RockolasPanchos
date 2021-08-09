<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use App\Models\Productos\Categoria;
use App\Models\Productos\DetallePaquete;
use App\Models\Productos\Paquete;
use App\Models\Productos\Producto;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Foreach_;
use stdClass;

class PaqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mPaquetes = Paquete::all();
        return view('productos.paquetes.index', compact('mPaquetes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mProductos = DB::table('producto')
            ->select("producto.id", "producto.nombre", "producto.categoria_id")
            ->get();

        $mCategorias = Categoria::all()->sortBy("id");

        $mPreciosUnitarios = DB::table('producto')
            ->select('producto.id', 'producto.precioUnitario')
            ->get()
            ->toArray();

        $mPreciosUnitarios = json_encode($mPreciosUnitarios);

        return view("productos.paquetes.create", compact('mProductos', 'mCategorias', 'mPreciosUnitarios', 'hola'));
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
            "nombre" => "required|unique:paquete,nombre",
            "imagen" => "required|image|mimes:png,jpg,jpeg",
            "silla" => "required",
            "sillaCantidad" => "required",
            "mesa" => "required",
            "mesaCantidad" => "required",
            "rockola" => "nullable|required_with:rockolaCantidad",
            "rockolaCantidad" => "required_with:rockola",
            "carpa" => "nullable|required_with:carpaCantidad",
            "carpaCantidad" => "required_with:carpa",
            "inflable" => "nullable|required_with:inflableCantidad",
            "inflableCantidad" => "required_with:inflable",
            "totalFinal" => "required"
        ]);

        $productos = $request->only('silla', 'mesa', 'rockola', 'carpa', 'inflable');

        DB::beginTransaction();
        try {
            $mPaquete = new Paquete();
            $mPaquete->nombre = $request->nombre;
            $mPaquete->precio = $request->totalFinal;
            $mPaquete->save();

            $file = $request->file('imagen');
            $imgNombreVirtual = $file->getClientOriginalName();
            $imgNombreFisico = $mPaquete->id . "_" . trim($request->nombre) . "_paquete" . "." . $file->getClientOriginalExtension();
            Storage::disk('local')->put($imgNombreFisico, File::get($file));
            $mPaquete->imgNombreVirtual = $imgNombreVirtual;
            $mPaquete->imgNombreFisico = $imgNombreFisico;
            $mPaquete->save();

            $dpController = new DetallePaqueteController();

            foreach (array_keys($productos) as $key) {
                $producto_id = -1;
                $cantidad = -1;
                switch ($key) {
                    case "silla":
                        $producto_id = $request->silla;
                        $cantidad = $request->sillaCantidad;
                        break;
                    case "mesa":
                        $producto_id = $request->mesa;
                        $cantidad = $request->mesaCantidad;
                        break;
                    case "rockola":
                        $producto_id = $request->rockola;
                        $cantidad = $request->rockolaCantidad;
                        break;
                    case "carpa":
                        $producto_id = $request->carpa;
                        $cantidad = $request->carpaCantidad;
                        break;
                    case "inflable":
                        $producto_id = $request->inflable;
                        $cantidad = $request->inflableCantidad;
                        break;
                }

                $dpController->store($mPaquete->id, $producto_id, $cantidad);
            }

            DB::commit();

            Session::flash('message', 'Paquete agregado con exito');
            Session::flash('alert-class', 'success');

            return redirect('paquetes');
        } catch (\Exception $e) {
            DB::rollBack();
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
        $mPaquete = Paquete::find($id);
        $mDetallesPaquete = DB::table('detalle_paquete')
            ->join('producto', 'detalle_paquete.producto_id', '=', 'producto.id')
            ->select(
                "producto.nombre",
                "producto.precioUnitario",
                "detalle_paquete.cantidad",
            )
            ->where("detalle_paquete.paquete_id", "=", $mPaquete->id)
            ->get();

        $precios = new stdClass;
        $precios->precio = array();
        foreach ($mDetallesPaquete as $detallesPaquete) {
            $precio = $detallesPaquete->precioUnitario * $detallesPaquete->cantidad;
            $precios->precio[] = $precio;
        }

        return view("productos.paquetes.show", compact('mPaquete', 'mDetallesPaquete', 'precios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mPaquete = Paquete::find($id);

        $mDetallesPaquete = DB::table('detalle_paquete')
            ->join('producto', 'producto.id', '=', 'detalle_paquete.producto_id')
            ->join('categoria', "categoria.id", "=", "producto.categoria_id")
            ->select(
                "producto.id as producto_id",
                "producto.nombre",
                "producto.precioUnitario",
                "detalle_paquete.cantidad",
                "categoria.categoria"
            )
            ->where("detalle_paquete.paquete_id", "=", $mPaquete->id)
            ->get();

        $mProductos = DB::table('producto')
            ->select("producto.id", "producto.nombre", "producto.categoria_id", "producto.precioUnitario")
            ->get();

        $mCategorias = Categoria::all()->sortBy("id");

        $mPreciosUnitarios = DB::table('producto')
            ->select('producto.id', 'producto.precioUnitario')
            ->get()
            ->toArray();

        $mPreciosUnitarios = json_encode($mPreciosUnitarios);

        return view("productos.paquetes.edit", compact('mPaquete', 'mDetallesPaquete', 'mProductos', 'mCategorias', 'mPreciosUnitarios'));
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
            "nombre" => "required|unique:paquete,nombre," . $id,
            "imagen" => "nullable|image|mimes:png,jpg,jpeg",
            "silla" => "required",
            "sillaCantidad" => "required",
            "mesa" => "required",
            "mesaCantidad" => "required",
            "rockola" => "nullable|required_with:rockolaCantidad",
            "rockolaCantidad" => "required_with:rockola",
            "carpa" => "nullable|required_with:carpaCantidad",
            "carpaCantidad" => "required_with:carpa",
            "inflable" => "nullable|required_with:inflableCantidad",
            "inflableCantidad" => "required_with:inflable",
            "totalFinal" => "required"
        ]);

        $productos = $request->only('silla', 'mesa', 'rockola', 'carpa', 'inflable');

        DB::beginTransaction();
        try {
            $mPaquete = Paquete::find($id);
            $mPaquete->nombre = $request->nombre;
            $mPaquete->precio = $request->totalFinal;

            $file = $request->file('imagen');
            if ($file) {
                $imgNombreFisico = $mPaquete->id . "_" . trim($request->nombre) . "_paquete" . "." . $file->getClientOriginalExtension();
                Storage::disk('local')->put($imgNombreFisico, File::get($file));
                $mPaquete->imgNombreVirtual = $file->getClientOriginalName();
                $mPaquete->imgNombreFisico = $imgNombreFisico;
            }

            $mPaquete->save();

            $dpController = new DetallePaqueteController();

            foreach (array_keys($productos) as $key) {
                $producto_id = -1;
                $cantidad = -1;
                switch ($key) {
                    case "silla":
                        $producto_id = $request->silla;
                        $cantidad = $request->sillaCantidad;
                        break;
                    case "mesa":
                        $producto_id = $request->mesa;
                        $cantidad = $request->mesaCantidad;
                        break;
                    case "rockola":
                        $producto_id = $request->rockola;
                        $cantidad = $request->rockolaCantidad;
                        break;
                    case "carpa":
                        $producto_id = $request->carpa;
                        $cantidad = $request->carpaCantidad;
                        break;
                    case "inflable":
                        $producto_id = $request->inflable;
                        $cantidad = $request->inflableCantidad;
                        break;
                }

                $dpController->store($mPaquete->id, $producto_id, $cantidad);
            }

            DB::commit();

            Session::flash('message', 'Paquete modificado exitosamente');
            Session::flash('alert-class', 'success');

            return redirect('paquetes');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
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
