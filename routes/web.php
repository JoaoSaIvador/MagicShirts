<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;




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

//Pages
Route::get('entrar', [UserController::class, 'index'])->name('Login');
Route::get('registar', [UserController::class, 'registerPage'])->name('Register');
Route::get('/',[HomeController::class,'index'])->name('Home');
Route::get('/home', [HomeController::class, 'index']);

Route::get('catalogo', [CatalogueController::class, 'index'])->name('Catalogue');
Route::get('catalogo/produto/{estampa}', [ProductController::class, 'index'])->name('Product.view');
Route::get('carrinho', [CartController::class, 'index'])->name('Cart');
Route::get('carrinho/checkout',  [CheckoutController::class, 'index'])->name('Checkout');

//Other
Route::post('catalogo', [ProductController::class, 'store'])->name('Product.store');
Route::post('carrinho', [CartController::class, 'store_tshirt'])->name('Cart.store');

Route::put('carrinho', [CartController::class, 'update_tshirt'])->name('carrinho.update_tshirt');
Route::delete('carrinho', [CartController::class, 'destroy_tshirt'])->name('carrinho.destroy_tshirt');

Auth::routes();


