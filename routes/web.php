<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('ventas','VentaController');
#Route::get('/venta/compra','VentaController@create');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::namespace('Usuarios')->group(function(){
    Route::resource('usuarios', 'UsuarioController');
});

Route::namespace('Productos')->group(function () {
    Route::resource('productos', 'ProductoController');
    Route::resource('categorias', 'CategoriaController');
});

Route::namespace('Rentas')->group(function () {
    Route::resource('renta', 'rentaController');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

