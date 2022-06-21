<?php

use App\Http\Controllers\ExperienciaController;
use App\Http\Controllers\JocController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VoucherController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/////////////////////////// Jocs ////////////////////////
Route::apiResource('/jocs', JocController::class);
/////////////////////////// Sales ///////////////////////
Route::apiResource('/salas', SalaController::class)->middleware('auth');
/////////////////////////// Reserves ///////////////////////
Route::apiResource('/reservas', ReservaController::class)->middleware('auth');
Route::get('/comprovaReserva', [ReservaController::class,'comprovaReserva']);
/////////////////////////// Experiencia ///////////////////////
Route::apiResource('/experiencies', ExperienciaController::class)->middleware('auth');
/////////////////////////// Voucher ///////////////////////
Route::apiResource('/vouchers', VoucherController::class)->middleware('auth');
/////////////////////////// Users ///////////////////////
Route::get('/users', [UsersController::class, 'index']);

Route::get('/users/{user}/editar', [UsersController::class, 'edit']);

Route::post('/users/{user}/actualitzar-user', [UsersController::class, 'update']);

