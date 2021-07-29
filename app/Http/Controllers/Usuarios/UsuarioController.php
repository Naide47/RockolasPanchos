<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Persona\PersonaController;
use App\Models\Usuarios\Persona;
use App\Models\Usuarios\Rol;
use App\Models\Usuarios\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $arUsuarios = DB::table('users')
        ->join('personas', 'users.idPersona', '=', 'personas.idPersona')
        ->select('users.id', 'users.email', 'users.idPersona', 'users.idRol', 'personas.nombre')
        ->get()->toArray();

        // $mUsuarios = Usuario::all(['id', 'email', 'idPersona', 'idRol'])->toArray();
        // $mPersonas = [];
        // foreach ($mUsuarios as $mUsuario) {
        //     $mPersona = Persona::select('nombre')->where('idPersona', $mUsuario['idPersona'])->get()->toArray();

        //     $mPersonas[] = $mPersona;
        // }
        // for($i = 0; i < count($mUsuarios); $i++) {
        //     $mUsuarios[]
        // }
        return view('usuarios.index', compact('arUsuarios'));
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
        DB::beginTransaction();
        try{

            $personaController = new  PersonaController();
            $idPersona = $personaController->store($request);

            $mUsuario = new Usuario();
            $mUsuario->name = $request->nombre;
            $mUsuario->idPersona = $idPersona;
            $mUsuario->email = $request->correo;
            $mUsuario->password = bcrypt($request->contrasenia);
            $mUsuario->idRol = $request->rol;
            $mUsuario->save();

            DB::commit();

            Session::flash('message', 'Usuario agregado con exito');
            Session::flash('alert-class', 'success');
            return redirect('usuarios');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'danger');
            return redirect('usuarios.create');
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
