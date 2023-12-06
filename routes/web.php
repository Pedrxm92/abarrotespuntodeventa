<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AutenticaController;
use App\Http\Controllers\PedidoController;
use App\Http\Middleware\CheckAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'inicio')->name('inicio');

// Rutas para Categorías
Route::resource('/categorias', CategoriaController::class);

// Rutas para Usuarios (Registro, Login, Logout, Perfil)
Route::view('/registro', 'autenticacion.registro')->name('registro');
Route::post('/registro', [AutenticaController::class, 'registro'])->name('registro.store');
Route::view('/login', 'autenticacion.login')->name('login');
Route::post('/login', [AutenticaController::class, 'login'])->name('login.store');
Route::post('/logout', [AutenticaController::class, 'logout'])->name('logout');
Route::get('/perfil', [AutenticaController::class, 'perfil'])->name('perfil');
Route::put('/perfil/{user}', [AutenticaController::class, 'perfilUpdate'])->name('perfil.update');
Route::put('/perfil/password/{user}', [AutenticaController::class, 'passwordUpdate'])->name('password.update');

// Rutas para Productos
Route::middleware(['auth'])->group(function () {
    Route::resource('productos', ProductoController::class);
    
    // Rutas para Pedidos
    Route::resource('/pedidos', PedidoController::class)->except(['create']);
    Route::get('/pedidos/create/{producto}', [PedidoController::class, 'create'])->name('pedidos.create');
    
    // Rutas para Productos que solo los admins pueden acceder
    Route::middleware(['App\Http\Middleware\CheckAdmin'])->group(function () {
        Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    });
});