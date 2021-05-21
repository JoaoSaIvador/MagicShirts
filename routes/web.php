<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;



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

Route::get('catalogo', [CatalogueController::class, 'index'])->name('Catalogue');
Route::get('catalogo/produto/{estampa}', [ProductController::class, 'index'])->name('Product.view');
Route::post('carrinho', [CartController::class, 'store'])->name('Cart.store');

Route::get('carrinho', [CartController::class, 'index'])->name('Cart');
Route::get('entrar', [UserController::class, 'index'])->name('Login');
Route::get('registar', [UserController::class, 'registerPage'])->name('Register');

Route::post('carrinho/produto', [CarrinhoController::class, 'store_tshirt'])->name('carrinho.store_tshirt');
Route::put('carrinho/produto', [CarrinhoController::class, 'update_tshirt'])->name('carrinho.update_tshirt');
Route::delete('carrinho', [CarrinhoController::class, 'destroy_tshirt'])->name('carrinho.destroy_tshirt');


Route::post('register', [UserController::class, 'register']);

