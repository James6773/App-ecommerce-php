<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('auth/login');
});

//Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/user', [UserController::class, 'index'])->name('user');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'actionEdit'])->name('user.action.edit');
Route::put('/user/{id}', [UserController::class, 'edit'])->name('user.edit');

Route::get('/seller', [SellerController::class, 'index'])->name('seller');
Route::post('/seller', [SellerController::class, 'store'])->name('seller.store');
Route::get('/seller/edit/{id}', [SellerController::class, 'actionEdit'])->name('seller.action.edit');
Route::put('/seller/{id}', [SellerController::class, 'edit'])->name('seller.edit');

Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
