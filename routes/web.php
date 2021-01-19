<?php

use App\Http\Controllers\{BrandController, CustomerController, DashboardController, EquipmentTypeController, RegistryController};
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

    Route::get('/clientes', [CustomerController::class, 'index'])->name('cadastros.cliente');
    Route::get('/clientes/buscar', [CustomerController::class, 'search'])->name('cadastros.cliente.buscar');
    Route::get('/clientes/incluir', [CustomerController::class, 'form'])->name('cadastros.cliente.incluir');
    Route::get('/clientes/{customer}', [CustomerController::class, 'show'])->name('cadastros.cliente.mostrar');
    Route::post('/clientes/gravar', [CustomerController::class, 'store'])->name('cadastros.cliente.gravar');

    Route::get('/usuarios', [UserController::class, 'index'])->name('cadastros.usuario');
    Route::get('/usuarios/buscar', [UserController::class, 'search'])->name('cadastros.usuario.buscar');
    Route::get('/usuarios/incluir', [UserController::class, 'form'])->name('cadastros.usuario.incluir');
    Route::get('/usuarios/{user}', [UserController::class, 'show'])->name('cadastros.usuario.mostrar');
    Route::post('/usuarios/gravar', [UserController::class, 'store'])->name('cadastros.usuario.gravar');

    Route::get('/marcas', [BrandController::class, 'index'])->name('cadastros.marca');
    Route::get('/marcas/buscar', [BrandController::class, 'search'])->name('cadastros.marca.buscar');
    Route::get('/marcas/incluir', [BrandController::class, 'form'])->name('cadastros.marca.incluir');
    Route::get('/marcas/{brand}', [BrandController::class, 'show'])->name('cadastros.marca.mostrar');
    Route::post('/marcas/gravar', [BrandController::class, 'store'])->name('cadastros.marca.gravar');

    Route::get('/tipos', [EquipmentTypeController::class, 'index'])->name('cadastros.tipo');
    Route::get('/tipos/buscar', [EquipmentTypeController::class, 'search'])->name('cadastros.tipo.buscar');
    Route::get('/tipos/incluir', [EquipmentTypeController::class, 'form'])->name('cadastros.tipo.incluir');
    Route::get('/tipos/{equipment_type}', [EquipmentTypeController::class, 'show'])->name('cadastros.tipo.mostrar');
    Route::post('/tipos/gravar', [EquipmentTypeController::class, 'store'])->name('cadastros.tipo.gravar');
    
});

Route::group(['prefix' => '/registros'], function () {
    Route::get('/', [RegistryController::class, 'index'])->name('registros');
});
