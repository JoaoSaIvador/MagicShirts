<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\StampsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\UserController;
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

Route::get('estampa/create', [StampsController::class, 'create'])->name('Stamps.create');
Route::get('estampa/{estampa}/edit', [StampsController::class, 'edit'])->name('Stamps.edit');
Route::get('estampa/pessoal/{estampa}/imagem', [StampsController::class , 'view_image'])->name('Stamp.image');
Route::post('estampa/store', [StampsController::class, 'store'])->name('Stamps.store');
Route::put('estampa/{estampa}', [StampsController::class, 'update'])->name('Stamps.update');
Route::delete('estampa/{estampa}', [StampsController::class, 'destroy'])->name('Stamps.delete');

Route::get('carrinho', [CartController::class, 'index'])->name('Cart');
Route::post('carrinho', [CartController::class, 'store_tshirt'])->name('Cart.store');
Route::put('carrinho', [CartController::class, 'update_tshirt'])->name('Cart.update');
Route::delete('carrinho', [CartController::class, 'destroy_tshirt'])->name('Cart.destroy');

Route::get('encomendas', [OrdersController::class, 'index'])->name('Orders');
Route::get('encomendas/{encomenda}', [OrdersController::class, 'view_details'])->name('Orders.view');
Route::put('encomendas/{encomenda}', [OrdersController::class, 'update'])->name('Orders.update');
Route::get('encomendas/filtro/{tipo}', [OrdersController::class, 'filter'])->name('Orders.filter');

Route::get('admin/cores', [ColorsController::class, 'index'])->name('Colors');
Route::get('admin/cores/create', [ColorsController::class, 'create'])->name('Colors.create');
Route::get('admin/cores/{cor}/edit', [ColorsController::class, 'edit'])->name('Colors.edit');
Route::post('admin/cores/store', [ColorsController::class, 'store'])->name('Colors.store');
Route::put('admin/cores/{cor}', [ColorsController::class, 'update'])->name('Colors.update');
Route::delete('admin/cores/{cor}', [ColorsController::class, 'destroy'])->name('Colors.delete');

Route::get('admin/users', [UserController::class, 'indexUsers'])->name('Users');
Route::put('admin/users/{user}/permissao', [UserController::class, 'permission'])->name('Users.permissions');
Route::put('admin/users/{user}/bloquear', [UserController::class, 'block'])->name('Users.block');
Route::delete('admin/users/{user}/delete', [UserController::class, 'delete'])->name('Users.delete');

Route::get('admin/estampas', [StampsController::class, 'index'])->name('Stamps');

Route::get('dashboard', [DashboardController::class, 'index'])->name('Dashboard')->middleware('can:accessDashboard');

Route::post('register', [UserController::class, 'register']);
Auth::routes(['verify' => true]);




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
