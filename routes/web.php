<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AutenticaController;
use App\Http\Controllers\PedidoController;
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
Route::view('/','inicio')->name('inicio');
Route::resource('/categorias',CategoriaController::class); //Crea 7 rutas para el CRUD de categorias
Route::resource('productos', ProductoController::class); //Crea 7 rutas para el CRUD de productos

//Ruta de registro de usuarios
route::view('/registro', 'autenticacion.registro')->name('registro');
route::post('/registro', [AutenticaController::class, 'registro'])->name('registro.store');
//Ruta de login de usuarios
route::view('/login', 'autenticacion.login')->name('login');
route::post('/login', [AutenticaController::class, 'login'])->name('login.store');
//Ruta de logout del usuario
route::post('/logout', [AutenticaController::class, 'logout'])->name('logout');
//Ruta para editar el perfil de usuario
Route::get('/perfil', [AutenticaController::class, 'perfil'])->name('perfil');
Route::put('/perfil/{user}',[AutenticaController::class,'perfilUpdate'])->name('perfil.update');
//Ruta para cambiar la contraseña de usuario
Route::put('/perfil/password/{user}',[AutenticaController::class,'passwordUpdate'])->name('password.update');
//Rutas para pedidos
Route::resource('/pedidos', PedidoController::class)->except(['create']);
Route::get('/pedidos/create/{producto}', [PedidoController::class, 'create'])->name('pedidos.create');