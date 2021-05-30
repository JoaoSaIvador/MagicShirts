<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\OrdersController;
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
Route::get('/home', [HomeController::class, 'index']);

Route::get('admin', [DashboardController::class, 'index'])->name('Dashboard');

Route::get('catalogo', [CatalogueController::class, 'index'])->name('Catalogue');
Route::get('catalogo/produto/{estampa}', [CatalogueController::class, 'view_product'])->name('Product.view');
Route::get('catalogo/create', [CatalogueController::class, 'create'])->name('Product.create');
Route::get('catalogo/edit/{estampa}', [CatalogueController::class, 'edit'])->name('Product.edit');
Route::post('catalogo/{estampa}', [CatalogueController::class, 'store'])->name('Product.store');
Route::put('catalogo/{estampa}', [CatalogueController::class, 'update'])->name('Product.update');
Route::delete('catalogo/{estampa}', [CatalogueController::class, 'destroy'])->name('Product.destroy');

Route::get('carrinho', [CartController::class, 'index'])->name('Cart');
Route::post('carrinho', [CartController::class, 'store_tshirt'])->name('Cart.store');
Route::put('carrinho', [CartController::class, 'update_tshirt'])->name('Cart.update');
Route::delete('carrinho', [CartController::class, 'destroy_tshirt'])->name('Cart.destroy');

Route::get('encomendas', [OrdersController::class, 'index'])->name('Orders');
Route::get('encomendas/{encomenda}', [OrdersController::class, 'view_details'])->name('Orders.view');
Route::put('encomendas/{encomenda}', [OrdersController::class, 'update'])->name('Orders.update');

Route::post('register', [UserController::class, 'register']);
Auth::routes();


