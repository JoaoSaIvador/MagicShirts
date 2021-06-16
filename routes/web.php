<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\StampsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PricesController;
use App\Http\Controllers\PDFController;
use App\Http\Policies\UserPolicy;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Home

Route::get('/', [HomeController::class, 'index'])->name('Home');
Route::get('/home', [HomeController::class, 'index'])->name('home');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Catalogue

Route::get('catalogo', [CatalogueController::class, 'index'])->name('Catalogue')->middleware('can:viewCatalogue,App\Models\Estampa');
Route::get('catalogo/produto/{estampa}', [CatalogueController::class, 'view_product'])->name('Catalogue.view')->middleware('can:view,estampa');
Route::get('catalogo/pessoal', [CatalogueController::class, 'view_personal'])->name('Catalogue.personal')->middleware('can:viewPersonal,App\Models\Estampa');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Admin Stamps

Route::get('admin/estampas', [StampsController::class, 'index'])->name('Stamps')->middleware('can:viewAny,App\Models\Estampa');
Route::get('admin/estampas/pessoais', [StampsController::class, 'index_private'])->name('Stamps.private')->middleware('can:viewPersonalStamps,App\Models\Estampa');
Route::get('admin/estampa/create', [StampsController::class, 'create'])->name('Stamps.create')->middleware('can:create,App\Models\Estampa');
Route::get('admin/estampa/{estampa}/edit', [StampsController::class, 'edit'])->name('Stamps.edit')->middleware('can:update,estampa');
Route::get('estampa/pessoal/{estampa}/imagem', [StampsController::class, 'view_image'])->name('Stamp.image')->middleware('can:viewPrivate,estampa');
Route::post('estampa/store', [StampsController::class, 'store'])->name('Stamps.store')->middleware('can:create, App\Models\Estampa');
Route::put('estampa/{estampa}', [StampsController::class, 'update'])->name('Stamps.update')->middleware('can:update, estampa');
Route::delete('estampa/{estampa}', [StampsController::class, 'destroy'])->name('Stamps.delete')->middleware('can:delete, App\Models\Estampa');
Route::post('admin/estampa/restore', [StampsController::class, 'restore'])->name('Stamps.restore')->middleware('can:restore, App\Models\Estampa');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Cart

Route::get('carrinho', [CartController::class, 'index'])->name('Cart')->middleware('can:create,App\Models\Encomenda');
Route::post('carrinho', [CartController::class, 'store_tshirt'])->name('Cart.store')->middleware('can:create,App\Models\Encomenda');
Route::patch('carrinho/{index}', [CartController::class, 'update_tshirt'])->name('Cart.update')->middleware('can:create,App\Models\Encomenda');
Route::delete('carrinho/{index}', [CartController::class, 'destroy_tshirt'])->name('Cart.destroy')->middleware('can:create,App\Models\Encomenda');

Route::middleware('auth')->prefix('carrinho')->group(function () {
    Route::get('checkout',  [CheckoutController::class, 'index'])->name('Checkout');
    Route::post('checkout', [CheckoutController::class, 'finalize_order'])->name('Checkout.finalize');
});


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Admin

Route::get('dashboard', [DashboardController::class, 'index'])->name('Dashboard')->middleware('can:accessDashboard');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Admin Orders

Route::get('admin/encomendas', [OrdersController::class, 'index'])->name('Orders')->middleware('can:viewAny, App\Models\Encomenda');
Route::get('admin/encomendas/{encomenda}', [OrdersController::class, 'view_details'])->name('Orders.view')->middleware('can:view,encomenda');
Route::patch('admin/encomendas/{encomenda}', [OrdersController::class, 'update'])->name('Orders.update')->middleware('can:update, App\Models\Encomenda');
Route::get('admin/encomendas/changefilter/{Filter}', [OrdersController::class, 'changefilter'])->name('Orders.changefilter')->middleware('can:viewAny, App\Models\Encomenda');
Route::get('admin/encomendas/filter/{Filter}', [OrdersController::class, 'filter'])->name('Orders.filter')->middleware('can:viewAny, App\Models\Encomenda');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Admin Users

Route::get('admin/users', [UserController::class, 'indexUsers'])->name('Users')->middleware('can:viewAny,App\Models\User');
Route::get('admin/users/filter', [UserController::class, 'indexUsers'])->name('Users.filter')->middleware('can:viewAny,App\Models\User');
Route::patch('admin/users/{user}/permissao', [UserController::class, 'permission'])->name('Users.permissions')->middleware('can:update,user');
Route::patch('admin/users/{user}/bloquear', [UserController::class, 'block'])->name('Users.block')->middleware('can:update,user');
Route::delete('admin/users/{user}/delete', [UserController::class, 'delete'])->name('Users.delete')->middleware('can:delete,App\Models\User');
Route::patch('admin/users/restore', [UserController::class, 'restore'])->name('Users.restore')->middleware('can:restore,App\Models\User');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Admin Categories

Route::get('admin/categorigas', [CategoryController::class, 'index'])->name('Categories')->middleware('can:viewAny,App\Models\Categoria');
Route::get('admin/categorias/create', [CategoryController::class, 'create'])->name('Categories.create')->middleware('can:create,App\Models\Categoria');
Route::get('admin/categorias/{categoria}/edit', [CategoryController::class, 'edit'])->name('Categories.edit')->middleware('can:update,categoria');
Route::post('admin/categorias/store', [CategoryController::class, 'store'])->name('Categories.store')->middleware('can:create,App\Models\Categoria');
Route::put('admin/categorias/{categoria}', [CategoryController::class, 'update'])->name('Categories.update')->middleware('can:update,categoria');
Route::delete('admin/categorias/{categoria}', [CategoryController::class, 'destroy'])->name('Categories.delete')->middleware('can:delete,App\Models\Categoria');
Route::post('admin/categorias/restore', [CategoryController::class, 'restore'])->name('Categories.restore')->middleware('can:restore,App\Models\Categoria');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Admin Colors

Route::get('admin/cores', [ColorsController::class, 'index'])->name('Colors')->middleware('can:viewAny,App\Models\Cor');
Route::get('admin/cores/create', [ColorsController::class, 'create'])->name('Colors.create')->middleware('can:viewAny,App\Models\Cor');
Route::get('admin/cores/{cor}/edit', [ColorsController::class, 'edit'])->name('Colors.edit')->middleware('can:viewAny,App\Models\Cor');
Route::post('admin/cores/store', [ColorsController::class, 'store'])->name('Colors.store')->middleware('can:viewAny,App\Models\Cor');
Route::put('admin/cores/{cor}', [ColorsController::class, 'update'])->name('Colors.update')->middleware('can:viewAny,App\Models\Cor');
Route::delete('admin/cores/{cor}', [ColorsController::class, 'destroy'])->name('Colors.delete')->middleware('can:delete,App\Models\Cor');
Route::post('admin/cores/restore', [ColorsController::class, 'restore'])->name('Colors.restore')->middleware('can:restore,App\Models\Cor');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Admin Prices

Route::get('admin/precos', [PricesController::class, 'index'])->name('Prices')->middleware('can:viewAny,App\Models\Preco');
Route::post('admin/precos/{preco}', [PricesController::class, 'update'])->name('Prices.update')->middleware('can:viewAny,App\Models\Preco');
Route::get('admin/precos/{preco}/edit', [PricesController::class, 'edit'])->name('Prices.edit')->middleware('can:viewAny,App\Models\Preco');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Profile

Route::middleware('auth')->group(function () {
    Route::get('perfil', [ProfileController::class, 'index'])->name('Profile');
    Route::put('perfil', [ProfileController::class, 'edit'])->name('Profile.edit');
    Route::put('perfil/{user}', [ProfileController::class, 'password_update'])->name('Profile.password');
    Route::delete('perfil', [ProfileController::class, 'destroy_foto'])->name('Profile.foto.destroy');
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Encomendas

Route::middleware('auth')->group(function () {
    Route::get('encomendas', [OrdersController::class, 'client_history'])->name('Orders.client')->middleware('can:viewOrderHistory, App\Models\Encomenda');;
    Route::get('encomendas/{encomenda}', [OrdersController::class, 'view_details'])->name('Order.client.view')->middleware('can:view,encomenda');
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Register

Route::post('register', [UserController::class, 'register']);
Auth::routes(['verify' => true]);


Route::get('recibo/{recibo}', [PDFController::class, 'download_receipt'])->name('Pdf.download');
