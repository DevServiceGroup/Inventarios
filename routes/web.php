<?php

use App\Http\Controllers\EntradasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalidasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\TablasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes(['register' => false]);
Route::resource('admin/profile', ProfileController::class)->names('admin.profile')->middleware('auth');
Route::resource('admin/cliente', ClientesController::class)->names('admin.cliente')->middleware('can:admin');
Route::resource('admin/productos',ProductosController::class)->names('admin.productos')->middleware('can:admin');
Route::resource('admin/entradas',EntradasController::class)->names('admin.entradas')->middleware('auth');
Route::resource('admin/salidas',SalidasController::class)->names('admin.salidas')->middleware('auth');
Route::get('admin/inventario' ,function(){
return view('inventario');
})->name('admin.inventario')->middleware('auth');


Route::get('salidas', [TablasController::class, 'salidas'])->name('salidas')->middleware('auth');
Route::get('verinventario', [TablasController::class, 'verinventario'])->name('verinventario')->middleware('auth');
Route::get('entradas', [TablasController::class, 'entradas'])->name('entradas')->middleware('auth');
Route::get('vewEntradas/{id}', [TablasController::class, 'vewEntradas'])->name('vewEntradas')->middleware('auth');
Route::get('vewSalidas/{mensaje}', [TablasController::class, 'vewSalidas'])->name('vewSalidas')->middleware('auth');
Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
