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

Route::get('/', 'FrontController@index')->name('home');

Route::get('/login', 'Auth\AuthController@loginPage')->name('login');
Route::post('/login', 'Auth\AuthController@login');
Route::post('/logout', 'Auth\AuthController@logout')->name('logout');

Route::get('/ventas/comprar', 'VentaController@create')->name('comprar');
Route::get('/ventas/agregarCarrito', 'VentaController@agregarCarrito')->name('agregarCarrito');
Route::get('/ventas/showCarrito', 'VentaController@showCarrito')->name('mostrarCarrito');
Route::post('/ventas/eliminaritem', 'VentaController@elimnarItemCarrito')->name('eliminarItemCarrito');
Route::get('/ventas/compras', 'VentaController@compras')->name('compras');
Route::post('/ventas/compras/comprar', 'VentaController@guardarCompra')->name('guardarCompra');
Route::post('/ventas/comprar/confimar', 'VentaController@store')->name('ventas.store2');



Route::group(['middleware' => ['auth']], function () {
    Route::get('/ventas/mostrar', 'VentaController@mostrar')->name('mostrar');
    Route::get('/ventas/mostrar/enproceso', 'VentaController@enproceso')->name('enproceso');
    Route::get('/ventas/mostrar/completas', 'VentaController@completas')->name('completas');
    Route::get('/ventas/mostrar/tomar', 'VentaController@tomar')->name('tomar');
    Route::get('/ventas/mostrar/completar', 'VentaController@completar')->name('completar');

    Route::get('/devolucion/mostrar', 'DevolucionController@mostrar')->name('devolucion.mostrar');

    Route::namespace('Usuarios')->group(function () {
        Route::get('/usuarios/inactivos', 'UsuarioController@inactiveIndex')->name('usuarios.inactivos');
        Route::put('/usuarios/reactivar/{id}', 'UsuarioController@reactivate')->name('usuarios.reactivate');

        Route::resource('usuarios', 'UsuarioController');
    });

    Route::namespace('Productos')->group(function () {
        Route::get('/productos/reporte', "ProductoController@generarReporte")->name("productos.generarReporte");
        Route::resource('productos', 'ProductoController');
        Route::resource('categorias', 'CategoriaController');
        Route::resource('paquetes', 'PaqueteController');
    });
});

Route::get('/', 'VentaController@index')->name('home');
Route::get('/login', 'Auth\AuthController@loginPage')->name('login');
Route::post('/login', 'Auth\AuthController@login');
Route::post('/logout', 'Auth\AuthController@logout')->name('logout');
#Route::get('/venta/compra','VentaController@create');

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');

Route::namespace('Rentas')->group(function () {
    Route::resource('renta', 'rentaController');
    Route::resource('rentaUsuario', 'RentaControllerUsuario');
});
