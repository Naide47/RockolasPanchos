<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Controller;
use App\Models\Productos\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mCategorias = Categoria::all()->sortBy("id");
        return view('categorias.index', compact('mCategorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
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
            'categoria'=> 'required|unique:categoria,categoria'
        ]);

        $mCategoria = new Categoria();
        $mCategoria->categoria = ucfirst($request->categoria);
        $mCategoria->save();

        Session::flash('message', 'Categoria agregada con exito');
        Session::flash('alert-class', 'success');
        return Redirect::to('categorias');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
    public function show($id)
    {
        $mCategoria = Categoria::find($id);
        return view('categorias.show', compact('mCategoria'));
    }
    */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mCategoria = Categoria::find($id);
        return view('categorias.edit', compact('mCategoria'));
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
            'categoria'=> 'required|unique:categoria,categoria'
        ]);

        $mCategoria = Categoria::find($id);
        $mCategoria->categoria = ucfirst($request->categoria);
        $mCategoria->save();

        Session::flash('message', 'Categoria actualizada con exito');
        Session::flash('alert-class', 'success');
        return redirect('categorias');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        Session::flash('message', 'Categoria eliminada con exito');
        Session::flash('alert-class', 'success');
        return redirect('categorias');
    }
    */
}
