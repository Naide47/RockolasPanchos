<?php

use App\Http\Controllers\Productos\CategoriaController;
use App\Http\Controllers\Productos\ProductoController;
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
Route::post('/ventas/comprar', 'VentaController@create')->name('comprar');
Route::post('/ventas/agregarCarrito', 'VentaController@agregarCarrito')->name('agregarCarrito');
Route::post('/ventas/eliminaritem', 'VentaController@elimnarItemCarrito')->name('eliminarItemCarrito');
#Route::get('/ventas/pdf', 'PDFController@createPDFVentas');

// Route::get('/pdf', function (Codedge\Fpdf\Fpdf\Fpdf $fpdf) {

//     $fpdf->AddPage();
//     $fpdf->SetFont('Courier', 'B', 18);
//     $fpdf->Cell(50, 25, 'Hello World!');
//     $fpdf->Output();

// });

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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');