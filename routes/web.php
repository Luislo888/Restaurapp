

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CamareroController;
use App\Http\Controllers\CocineroController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register', [App\Http\Controllers\AdminController::class, 'index'])->name('register');

Route::resource('/admin', AdminController::class);
Route::resource('/camarero', CamareroController::class);
Route::resource('/cocinero', CocineroController::class);

Route::post('/comanda', [App\Http\Controllers\ComandaController::class, 'store'])->name('comanda');
Route::get('/comanda/{id}', [App\Http\Controllers\ComandaController::class, 'show'])->name('comanda-edit');
Route::patch('/comanda/{id}', [App\Http\Controllers\ComandaController::class, 'update'])->name('comanda-update');
Route::patch('/comanda/{id}/{estado}', [App\Http\Controllers\ComandaController::class, 'cambiarEstadoComanda'])->name('comanda-update');
Route::patch('/comanda/{id}/{comandasProductosID}/{estadoProducto}', [App\Http\Controllers\ComandaController::class, 'cambiarEstadoProducto'])->name('comanda-update');
Route::delete('/comanda/{id}', [App\Http\Controllers\ComandaController::class, 'cancelar'])->name('comanda-update');
Route::post('/comanda/{id}', [App\Http\Controllers\ComandaController::class, 'update'])->name('comanda-update');
