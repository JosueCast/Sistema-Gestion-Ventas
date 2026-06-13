<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//controladores
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Routing\Router;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//recursos para clientes
Route::resource('clientes', ClienteController::class)->middleware('auth');
    Route::patch('/clientes/{cliente}/toggle-estado', [ClienteController::class, 'toggleEstado'])->name('clientes.toggleEstado')->middleware('auth');
//recursos para productos
Route::resource('productos', ProductoController::class)->middleware('auth');

//recuros para pedidos
Route::resource('pedidos', PedidosController::class)->middleware('auth');

//recursos para categorias
Route::resource('categorias', CategoriaController::class)->middleware('auth');
Route::patch('/categorias/{categoria}/toggle-estado', [CategoriaController::class, 'toggleEstado'])->name('categorias.toggleEstado')->middleware('auth');


require __DIR__.'/auth.php';
