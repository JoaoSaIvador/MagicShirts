<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\EstampasController;
use App\Http\Controllers\TshirtsController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\EncomendasController;



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
Route::get('carrinho', [CartController::class, 'index'])->name('Cart');
Route::get('entrar', [UserController::class, 'index'])->name('Login');
Route::get('registar', [UserController::class, 'registerPage'])->name('Register');

