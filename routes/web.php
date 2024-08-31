<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/login',[AuthController::class,'login'])->name('login');
// Route::post('/login',[AuthController::class,'postLogin'])->name('postLogin');

// Route::middleware('isAdmin')->group(function(){
//     Route::get('/', [AdminController::class, 'index'])->name('admin-dashboard');
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin-dashboard');
//     // banner
//     Route::get('/banners',[BannerController::class,'index'])->name('banners.index');
//     Route::get('/banner/create', [BannerController::class, 'create'])->name('banners.create');
//     Route::post('/banner/create', [BannerController::class, 'store'])->name('banners.store');
//     Route::delete('/banners/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');
//     Route::resource('/products', ProductController::class);
//     Route::resource('/categories', CategoryController::class);
//     Route::delete('/logout',[AuthController::class,'logout'])->name('logout');
//     //transaction
//     Route::get('/transaction',[TransactionController::class,'index'])->name('transaction.index');
//     Route::post('/add-transaction/{token}',[TransactionController::class,'addTransaction'])->name('transaction.add');
//     //order
//     Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
//     Route::get('/orders/accepted', [OrderController::class, 'getAccepted'])->name('orders.accepted');
//     Route::get('/orders/canceled', [OrderController::class, 'getCanceled'])->name('orders.canceled');
//     Route::get('/orders/{id}',[OrderController::class,'showOrderItems'])->name('orders.showOrderItems');
//     Route::post('/order/{id}/accept',[OrderController::class,'acceptStatus'])->name('orders.accept');
//     Route::post('/order/{id}/cancel',[OrderController::class,'cancelStatus'])->name('orders.cancel');
// });
Route::get('/', function () {
    return 'welcome';
});
