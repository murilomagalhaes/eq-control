<?php

use App\Http\Controllers\{BrandController, CustomerController, DashboardController, EquipmentController, EquipmentTypeController, RegistryController};
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteRegistrar;
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
    Route::get('/clientes/ajax{id?}', [CustomerController::class, 'ajax'])->name('cadastros.cliente.ajax');
    Route::get('/clientes/buscar', [CustomerController::class, 'search'])->name('cadastros.cliente.buscar');
    Route::get('/clientes/incluir', [CustomerController::class, 'form'])->name('cadastros.cliente.incluir');
    Route::get('/clientes/{customer}', [CustomerController::class, 'show'])->name('cadastros.cliente.mostrar');
    Route::post('/clientes/gravar', [CustomerController::class, 'store'])->name('cadastros.cliente.gravar');

    Route::get('/usuarios', [UserController::class, 'index'])->name('cadastros.usuario');
    Route::get('/usuarios/ajax/{id?}', [UserController::class, 'ajax'])->name('cadastros.usuario.ajax');
    Route::get('/usuarios/buscar', [UserController::class, 'search'])->name('cadastros.usuario.buscar');
    Route::get('/usuarios/incluir', [UserController::class, 'form'])->name('cadastros.usuario.incluir');
    Route::get('/usuarios/{user}', [UserController::class, 'show'])->name('cadastros.usuario.mostrar');
    Route::post('/usuarios/gravar', [UserController::class, 'store'])->name('cadastros.usuario.gravar');

    Route::get('/marcas', [BrandController::class, 'index'])->name('cadastros.marca');
    Route::get('marcas/ajax{id?}', [BrandController::class, 'ajax'])->name('cadastros.marca.ajax');
    Route::get('/marcas/buscar', [BrandController::class, 'search'])->name('cadastros.marca.buscar');
    Route::get('/marcas/incluir', [BrandController::class, 'form'])->name('cadastros.marca.incluir');
    Route::get('/marcas/{brand}', [BrandController::class, 'show'])->name('cadastros.marca.mostrar');
    Route::post('/marcas/gravar', [BrandController::class, 'store'])->name('cadastros.marca.gravar');

    Route::get('/tipos', [EquipmentTypeController::class, 'index'])->name('cadastros.tipo');
    Route::get('/tipos/buscar', [EquipmentTypeController::class, 'search'])->name('cadastros.tipo.buscar');
    Route::get('/tipos/ajax{id?}', [EquipmentTypeController::class, 'ajax'])->name('cadastros.tipo.ajax');
    Route::get('/tipos/incluir', [EquipmentTypeController::class, 'form'])->name('cadastros.tipo.incluir');
    Route::get('/tipos/{equipment_type}', [EquipmentTypeController::class, 'show'])->name('cadastros.tipo.mostrar');
    Route::post('/tipos/gravar', [EquipmentTypeController::class, 'store'])->name('cadastros.tipo.gravar');
});

Route::group(['prefix' => '/registros'], function () {
    Route::get('/', [RegistryController::class, 'index'])->name('registros');
    Route::get('/buscar', [RegistryController::class, 'search'])->name('registros.buscar');
    Route::get('/incluir', [RegistryController::class, 'form'])->name('registros.incluir');
    Route::get('/editar/{registry}', [RegistryController::class, 'form'])->name('registros.editar');
    Route::get('/{registry}', [RegistryController::class, 'show'])->name('registros.mostrar');
    Route::get('/imprimir/{registry}', [RegistryController::class, 'print'])->name('imprimir');
    Route::get('/imprimir/saida/{registry}', [RegistryController::class, 'printExit'])->name('imprimir.saida');
    Route::get('/incluir/equipamento', [RegistryController::class, 'addEquipment'])->name('registros.equipamento.incluir');
    Route::post('/atualizar', [RegistryController::class, 'update'])->name('registros.atualizar');
    Route::post('/gravar', [RegistryController::class, 'store'])->name('registros.gravar');
    Route::get('/saida/{registry}', [RegistryController::class, 'exitForm'])->name('registros.saida.incluir');
    Route::post('/saida', [RegistryController::class, 'storeExit'])->name('registros.saida.gravar');

    Route::get('/equipamentos/editar/{equipment}', [EquipmentController::class, 'form'])->name('registros.equipamentos.editar');
    Route::post('/equipamentos/atualizar', [EquipmentController::class, 'update'])->name('registros.equipamentos.atualizar');
});
