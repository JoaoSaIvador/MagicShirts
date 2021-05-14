<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\EncomendasController;
use App\Http\Controllers\EstampasPropriasController;

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

//Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/', [CatalogoController::class, 'index'])->name('catalogo.index');
Route::get('carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::get('encomendas', [EncomendasController::class, 'index'])->name('encomendas.index');
Route::get('estampasProprias', [EstampasPropriasController::class, 'index'])->name('estampasProprias.index');
