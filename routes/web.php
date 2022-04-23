

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ath\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CamareroController;
use App\Http\Controllers\CocineroController;

use App\Models\Comanda;
use App\Http\Controllers\ComandaController;
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

// Route::get('/', function () {
//     return view('/home');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/auth.register', [App\Http\Controllers\AdminController::class, 'index'])->name('register');
Route::get('/register', [App\Http\Controllers\AdminController::class, 'index'])->name('register');
// Route::get('/camarero', [App\Http\Controllers\CamareroController::class, 'index'])->name('camarero');

// Route::get('/camarero', function () {
//     return view('camarero');
// });

Route::resource('/admin', AdminController::class);
Route::resource('/camarero', CamareroController::class);
Route::resource('/cocinero', CocineroController::class);
Route::resource('/comanda', ComandaController::class);

Route::post('/comanda', [App\Http\Controllers\ComandaController::class, 'store'])->name('comanda');
Route::get('/comanda/{id}', [App\Http\Controllers\ComandaController::class, 'show'])->name('comanda-edit');
Route::post('/comanda/{id}', [App\Http\Controllers\ComandaController::class, 'update'])->name('comanda-update');


// Route::resource('/comanda', ComandaController::class);
