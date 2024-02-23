<?php

use App\Http\Controllers\EntradasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalidasController;
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
Route::resource('admin/profile', ProfileController::class)->names('admin.profile');
Route::resource('admin/productos',ProductosController::class)->names('admin.productos');
Route::resource('admin/entradas',EntradasController::class)->names('admin.entradas');
Route::resource('admin/salidas',SalidasController::class)->names('admin.salidas');
Route::get('admin/inventario' ,function(){
return view('inventario');
})->name('admin.inventario');


Route::get('salidas', [TablasController::class, 'salidas'])->name('salidas');
Route::get('verinventario', [TablasController::class, 'verinventario'])->name('verinventario');
Route::get('entradas', [TablasController::class, 'entradas'])->name('entradas');
Route::get('vewEntradas/{id}', [TablasController::class, 'vewEntradas'])->name('vewEntradas');
Route::get('vewSalidas/{mensaje}', [TablasController::class, 'vewSalidas'])->name('vewSalidas');
Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
