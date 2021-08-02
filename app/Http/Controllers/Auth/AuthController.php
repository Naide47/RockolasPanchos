<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('usuarios.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('usuarios.index');
        } else {
            return redirect()->back()->withErrors([
                "auth_error" => "Correo electronico o contraseña incorrectos"
            ]);
            // return redirect()->route('login')->withErrors([
            //     "password" => "Las credenciales no coinciden"
            // ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
