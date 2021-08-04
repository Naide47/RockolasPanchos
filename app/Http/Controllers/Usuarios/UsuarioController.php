<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Persona\PersonaController;
use App\Models\User;
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
        $mUsuarios = DB::table('users')
            ->join('persona', 'users.persona_id', '=', 'persona.id')
            ->join('rol', 'users.rol_id', '=', 'rol.id')
            ->select('users.id', 'users.email', 'persona.nombre', 'rol.rol')
            ->where('estatus', '=', 1)
            ->get()->toArray();

        return view('usuarios.index', compact('mUsuarios'));
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
            "correo" => "required|email",
            "contrasenia" => "required|min:5|max:12",
            "confContrasenia" => "required|same:contrasenia"
        ]);

        DB::beginTransaction();
        try {

            $personaController = new  PersonaController();
            $idPersona = $personaController->store($request);

            $mUsuario = new Usuario();
            $mUsuario->name = $request->nombre;
            $mUsuario->persona_id = $idPersona;
            $mUsuario->email = $request->correo;
            $mUsuario->password = bcrypt($request->contrasenia);
            $mUsuario->rol_id = $request->rol;
            $mUsuario->save();

            DB::commit();

            Session::flash('message', 'Usuario agregado con exito');
            Session::flash('alert-class', 'success');
            return redirect('usuarios');
        } catch (\Exception $e) {
            DB::rollBack();
            // Session::flash('message', $e->getMessage());
            // Session::flash('alert-class', 'danger');
            // return redirect()->back()->withErrors(['error', $e->getMessage()]);
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
        $mUsuario = DB::table('users')
            ->join('persona', 'users.persona_id', '=', 'persona.id')
            ->join('rol', 'users.rol_id', '=', 'rol.id')
            ->select('users.*', 'persona.*', 'rol.rol')
            ->where('users.id', '=', $id)
            // ->get()
            ->first();

        return view("usuarios.show", compact('mUsuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mUsuario = DB::table('users')
            ->join('persona', 'users.persona_id', '=', 'persona.id')
            ->join('rol', 'users.rol_id', '=', 'rol.id')
            ->select(
                'users.id as usuario_id',
                'users.email',
                'persona.id as persona_id',
                'persona.nombre',
                'persona.colonia',
                'persona.calle',
                'persona.codigoPostal',
                'persona.telefono',
                'persona.celular',
                'rol.rol'
            )
            ->where('users.id', '=', $id)
            ->first();

        $mRoles = Rol::all();

        return view("usuarios.edit", compact('mUsuario', 'mRoles'));
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
        // return redirect()->back()->withErrors(['hello'=>'Gretings from errors!']);
        $validacion = $request->validate([
            "nombre" => "required",
            "colonia" => "required",
            "calle" => "required",
            "codigoPostal" => "required",
            "telefono" => "required",
            "celular" => "required",
            "correo" => "required|email",
            "contrasenia" => "nullable|min:5|max:12",
            "confContrasenia" => "same:contrasenia"
        ]);

        $personaController = new  PersonaController();

        $mUsuario = Usuario::find($id);
        $personaController->update($request, $mUsuario->persona_id);

        $mUsuario->name = $request->nombre;
        $mUsuario->email = $request->correo;
        $mUsuario->password = bcrypt($request->contrasenia);
        $mUsuario->rol_id = $request->rol;

        $mUsuario->save();
        Session::flash('message', 'Usuario editado con exito');
        Session::flash('alert-class', 'success');
        return redirect('usuarios');
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

        Session::flash('message', 'Usuario ' . $mUsuario->name . ' eliminado con exito');
        Session::flash('alert-class', 'success');

        return redirect('usuarios');
    }

    /**
     * Retorna una lista de los usuarios inactivos
     * 
     * * @return \Illuminate\Http\Response
     */
    public function inactiveIndex()
    {
        $mUsuarios = DB::table('users')
            ->join('persona', 'users.persona_id', '=', 'persona.id')
            ->join('rol', 'users.rol_id', '=', 'rol.id')
            ->select('users.id', 'users.email', 'persona.nombre', 'rol.rol')
            ->where('estatus', '=', 0)
            ->get();

        return view('usuarios.inactivos', compact('mUsuarios'));
    }

    public function reactivate($id)
    {
        $mUsuario = Usuario::find($id);
        $mUsuario->estatus = 1;
        $mUsuario->save();

        Session::flash('message', 'Usuario ' . $mUsuario->name . ' reactivado con exito');
        Session::flash('alert-class', 'success');

        return redirect('usuarios');
    }
}
