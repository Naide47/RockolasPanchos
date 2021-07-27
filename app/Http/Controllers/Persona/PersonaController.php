<?php

namespace App\Http\Controllers\Persona;

use App\Http\Controllers\Controller;
use App\Models\Usuarios\Persona;
use Illuminate\Http\Request;


class PersonaController extends Controller
{
    /**
     * Almacena la información de una persona
     * 
     * @param \Illuminate\Http\Request  $request
     * @return int
     */
    public function store(Request $request)
    {
        $mPersona = new Persona();
        $mPersona->nombre = $request->nombre;
        $mPersona->colonia = $request->colonia;
        $mPersona->calle = $request->calle;
        $mPersona->codigoPostal = $request->codigoPostal;
        $mPersona->telefono = $request->telefono;
        $mPersona->celular = $request->celular;

        $mPersona->save();
        return $mPersona->idPersona;
    }

    /**
     * Actualiza la información de la persona
     * 
     * @param \Illuminate\Http\Request  $request
     * @param int $id
     */
    public function update(Request $request, $id) {
        $mPersona = Persona::find($id);
        $mPersona->nombre = $request->nombre;
        $mPersona->colonia = $request->colonia;
        $mPersona->calle = $request->calle;
        $mPersona->codigoPostal = $request->codigoPostal;
        $mPersona->telefono = $request->telefono;
        $mPersona->celular = $request->celular;

        $mPersona->save();
    }
}
