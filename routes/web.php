<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StampsController;
use App\Http\Controllers\ProfileController;
use App\Models\User;

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

//Route::get('admin', [DashboardController::class, 'index'])->name('Dashboard');

Route::get('catalogo', [CatalogueController::class, 'index'])->name('Catalogue');
Route::get('catalogo/produto/{estampa}', [CatalogueController::class, 'view_product'])->name('Catalogue.view');
Route::get('catalogo/pessoal', [CatalogueController::class, 'view_personal'])->name('Catalogue.personal');

Route::get('catalogo/create', [CatalogueController::class, 'create'])->name('Catalogue.create');
Route::get('catalogo/{estampa}/edit', [CatalogueController::class, 'edit'])->name('Catalogue.edit');
Route::get('catalogo/pessoal/{estampa}/imagem', [CatalogueController::class , 'view_image'])->name('Catalogue.image');

Route::post('catalogo', [CatalogueController::class, 'store'])->name('Catalogue.store');
Route::put('catalogo/{estampa}', [CatalogueController::class, 'update'])->name('Catalogue.update');
Route::delete('catalogo/{estampa}', [CatalogueController::class, 'destroy'])->name('Catalogue.destroy');

Route::get('carrinho', [CartController::class, 'index'])->name('Cart');
Route::post('carrinho', [CartController::class, 'store_tshirt'])->name('Cart.store');
Route::put('carrinho/{index}', [CartController::class, 'update_tshirt'])->name('Cart.update');
Route::delete('carrinho/{index}', [CartController::class, 'destroy_tshirt'])->name('Cart.destroy');

Route::middleware('auth')->prefix('carrinho')->group(function() {
    Route::get('checkout',  [CheckoutController::class, 'index'])->name('Checkout');
    Route::post('checkout', [CheckoutController::class, 'finalize_order'])->name('Checkout.finalize');
});

Route::get('encomendas', [OrdersController::class, 'index'])->name('Orders');
Route::get('encomendas/{encomenda}', [OrdersController::class, 'view_details'])->name('Orders.view');
Route::put('encomendas/{encomenda}', [OrdersController::class, 'update'])->name('Orders.update');

Route::get('encomendas/filtro/{tipo}', [OrdersController::class, 'filter'])->name('Orders.filter');

Route::get('users', [UserController::class, 'indexUsers'])->name('Users');
Route::put('users/{user}/permissao', [UserController::class, 'permission'])->name('Users.permissions');
Route::put('users/{user}/bloquear', [UserController::class, 'block'])->name('Users.block');
Route::delete('users/{user}/delete', [UserController::class, 'delete'])->name('Users.delete');

Route::get('estampas', [StampsController::class, 'index'])->name('Stamps');

Route::get('estampa/create', [StampsController::class, 'create'])->name('Stamps.create');
Route::get('estampa/{estampa}/edit', [StampsController::class, 'edit'])->name('Stamps.edit');
Route::get('estampa/pessoal/{estampa}/imagem', [StampsController::class , 'view_image'])->name('Stamp.image');
Route::post('estampa/store', [StampsController::class, 'store'])->name('Stamps.store');
Route::put('estampa/{estampa}', [StampsController::class, 'update'])->name('Stamps.update');
Route::delete('estampa/{estampa}', [StampsController::class, 'destroy'])->name('Stamps.delete');

Route::middleware('auth')->group(function() {
    Route::get('perfil', [ProfileController::class, 'index'])->name('Profile');
    Route::put('perfil', [ProfileController::class, 'edit'])->name('Profile.edit');
    Route::get('perfil/reset', [ProfileController::class, 'reset_password'])->name('Profile.reset');
    Route::delete('perfil', [ProfileController::class, 'destroy_foto'])->name('Profile.foto.destroy');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('Dashboard')->middleware('can:accessDashboard');

Route::post('register', [UserController::class, 'register']);
Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
