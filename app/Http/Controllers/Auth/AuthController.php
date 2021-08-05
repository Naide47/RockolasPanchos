<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function loginPage()
    {
        if (!Auth::check()) {
            return view('usuarios.login');
        } else {
            return redirect()->route('productos.index');
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->email;

        $estatus = DB::table('users')
            ->select('estatus')
            ->where('email', '=', $email)
            ->first();

        if ($estatus->estatus != 1) {
            return redirect()->back()->withErrors([
                "auth_error" => "Correo electronico o contraseña incorrectos"
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('productos.index');
        } else {
            return redirect()->back()->withErrors([
                "auth_error" => "Correo electronico o contraseña incorrectos"
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
