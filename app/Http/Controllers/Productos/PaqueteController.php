<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use App\Models\Productos\DetallePaquete;
use App\Models\Productos\Paquete;
use App\Models\Productos\Producto;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
            ->select("producto.id", "producto.nombre", "producto.categoria_id", "producto.precioUnitario")
            ->get();
        return view("productos.paquetes.create", compact('mProductos'));
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
            "nombre" => "required",
            "imagen" => "required",
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

        $totalFinal = substr($request->totalFinal, strpos($request->totalFinal, "$") + 1);

        DB::beginTransaction();
        try {
            $mPaquete = new Paquete();
            $mPaquete->nombre = $request->nombre;
            $mPaquete->precio = $totalFinal;
            $mPaquete->save();

            $file = $request->file('imagen');
            $fileName = strtok($file->getClientOriginalName(), ".jpg"); //Nombre sin extensión
            $imgNombreVirtual = $fileName . "." . $file->getClientOriginalExtension();
            $imgNombreFisico = $mPaquete->id . "_" . $fileName . "_paquete" . "." . $file->getClientOriginalExtension();
            Storage::disk('local')->put($imgNombreFisico, File::get($file));
            $mPaquete->imgNombreVirtual = $imgNombreVirtual;
            $mPaquete->imgNombreFisico = $imgNombreFisico;
            $mPaquete->save();

            $dpController = new DetallePaqueteController();

            $dpController->storeSilla($request->silla, $request->sillaCantidad, $mPaquete->id);
            $dpController->storeMesa($request->mesa, $request->mesaCantidad, $mPaquete->id);
            if ($request->rockola) {
                $dpController->storeRockola($request->rockola, $request->rockolaCantidad, $mPaquete->id);
            }
            if ($request->carpa) {
                $dpController->storeCarpa($request->carpa, $request->carpaCantidad, $mPaquete->id);
            }
            if ($request->inflable) {
                $dpController->storeInflable($request->inflable, $request->inflableCantidad, $mPaquete->id);
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
