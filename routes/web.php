<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StampsController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserController;



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


Route::get('/',[HomeController::class,'index'])->name('Home');
Route::get('estampas', [StampsController::class, 'index'])->name('Stamps');
Route::get('catalogo', [CatalogueController::class, 'index'])->name('Catalogue');
Route::get('carrinho', [OrdersController::class, 'orders'])->name('Cart');
Route::get('entrar', [UserController::class, 'index'])->name('Login');
Route::get('registar', [UserController::class, 'registerPage'])->name('Register');


Route::post('register', [UserController::class, 'register']);

