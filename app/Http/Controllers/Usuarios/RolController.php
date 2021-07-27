<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\Usuarios\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function store(Request $request) {
        
        $mRol = new Rol();
        $mRol->rol = $request->rol;
        
        $mRol->save();
    }
}
