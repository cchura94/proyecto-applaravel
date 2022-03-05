<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UsuarioController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum'])->prefix("admin")->group(function(){ 
    
    Route::get("/", function(){
        return view("admin.index");
    });

    Route::get("/producto/{id}/ingresos", [ProductoController::class, "registro_ingresos"])->name("producto_ingresos");
    Route::post("/producto/asignar_cantidad", [ProductoController::class, "asignar_cantidad"])->name("asignar_cantidad");
    
    Route::resource("categoria", CategoriaController::class);
    Route::resource("persona", PersonaController::class);
    Route::resource("cliente", ClienteController::class);
    Route::resource("pedido", PedidoController::class);
    Route::resource("producto", ProductoController::class);
    Route::resource("proveedor", ProveedorController::class);
    Route::resource("usuario", UsuarioController::class);

});
