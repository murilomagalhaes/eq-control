<?php

use App\Http\Controllers\{CustomerController, DashboardController};
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => '/cadastros'], function () {

    Route::get('/cliente', [CustomerController::class, 'index'])->name('cadastros.cliente');
    Route::get('/cliente/buscar', [CustomerController::class, 'search'])->name('cadastros.cliente.buscar');
    Route::get('/cliente/incluir', [CustomerController::class, 'form'])->name('cadastros.cliente.incluir');
    Route::get('/cliente/{customer}', [CustomerController::class, 'show'])->name('cadastros.cliente.mostrar');
    Route::post('/cliente/gravar', [CustomerController::class, 'store'])->name('cadastros.cliente.gravar');

    Route::get('/usuario', [UserController::class, 'index'])->name('cadastros.usuario');
    Route::get('/usuario/buscar', [UserController::class, 'search'])->name('cadastros.usuario.buscar');
    Route::get('/usuario/incluir', [UserController::class, 'form'])->name('cadastros.usuario.incluir');
    Route::get('/usuario/{user}', [UserController::class, 'show'])->name('cadastros.usuario.mostrar');
    Route::post('/usuario/gravar', [UserController::class, 'store'])->name('cadastros.usuario.gravar');
    
});
