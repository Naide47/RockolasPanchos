<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Persona\PersonaController;
use App\Models\Usuarios\Persona;
use App\Models\Usuarios\Rol;
use App\Models\Usuarios\Usuario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mUsuarios = Usuario::all(['id', 'email', 'idPersona', 'idRol'])->toArray();
        $mPersonas = array();
        foreach ($mUsuarios as $mUsuario) {
            // $mPersona = Persona::select('nombre')->where('idPersona', $mUsuario->idUsuario)->get();
            $mPersona = Persona::where('idPersona', $mUsuario->idPersona)->get(['nombre']);

            array_push($mPersonas, $mPersona);
        }
        return view('usuarios.index', compact('mUsuarios', 'mPersonas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mRoles = Rol::all();
        return view("usuarios.create", compact('mRoles'));
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
            "nombre" => "required",
            "colonia" => "required",
            "calle" => "required",
            "codigoPostal" => "required",
            "telefono" => "required",
            "celular" => "required",
            "correo" => "required",
            "contrasenia" => "required",
        ]);
        $personaController = new  PersonaController();
        $idPersona = $personaController->store($request);

        $mUsuario = new Usuario();
        $mUsuario->idPersona = $idPersona;
        $mUsuario->email = $request->correo;
        $mUsuario->password = bcrypt($request->contrasenia);
        $mUsuario->idRol = $request->rol;
        $mUsuario->save();

        Session::flash('success', 'Categoria agregada con exito');
        return redirect('usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mUsuario = Usuario::find($id);
        $mPersona = Persona::find($mUsuario->idPersona);
        $mRol = Rol::find($mUsuario->idRol);

        return view("usuarios.show", compact('mUsuario', 'mPersona', 'mRol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mUsuario = Usuario::find($id);
        $mPersona = Persona::find($mUsuario->idPersona);
        $mRol = Rol::find($mUsuario->idRol);

        return view("usuarios.edit", compact('mUsuario', 'mPersona', 'mRol'));
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
        $validacion = $request->validate([]);
        $personaController = new  PersonaController();

        $mUsuario = Usuario::find($id);
        $personaController->update($request, $mUsuario->idPersona);
        $mUsuario->email = $request->email;
        $mUsuario->password = bcrypt($request->password);
        $mUsuario->idRol = $request->rol;

        $mUsuario->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mUsuario = Usuario::find($id);
        $mUsuario->estatus = 0;
        $mUsuario->save();
    }
}
