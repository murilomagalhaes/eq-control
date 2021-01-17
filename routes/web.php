<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
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
    Route::get('/cliente/incluir', [CustomerController::class, 'new'])->name('cadastros.cliente.novo');
    Route::post('/cliente/store', [CustomerController::class, 'store'])->name('cadastros.cliente.gravar');
    Route::get('/cliente/buscar', [CustomerController::class, 'search'])->name('cadastros.cliente.search');
});
