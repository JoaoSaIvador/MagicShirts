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


Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('estampas', [EstampasController::class, 'index'])->name('estampas.index');
Route::get('t-shirts', [TshirtsController::class, 'index'])->name('t-shirts.index');
Route::get('catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
Route::get('carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::get('encomendas', [EncomendasController::class, 'index'])->name('encomendas.index');

