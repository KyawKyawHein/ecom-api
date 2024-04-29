<?php

use App\Http\Controllers\Api\RecommendController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Resources\UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    //Password Change
    Route::post('/password-change', [AuthController::class, 'passwordChange']);
    //Order
    Route::prefix('order')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::get('/get_orders_items/{id}', 'get_orders_item');
        Route::get('/get_users_orders/{id}', 'get_user_orders');
        Route::post('/change_order_status/{id}', 'change_order_status');
    });
    //add money
    Route::post('/add-money', [TransactionController::class, 'addMoney']);
    //add to cart
    Route::post('/add-to-cart', [CartController::class, 'addToCart']);
    Route::get('/show-cart', [CartController::class, 'showCart']);
    Route::post('remove-from-cart', [CartController::class, 'removeFromCart']);
    Route::post('remove-all-cart', [CartController::class, 'removeAllCart']);
    // Recommend
    Route::apiResource('/recommends', RecommendController::class);
});

Route::post("/register", [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//Shop
Route::apiResource('/shops', ShopController::class);
// User
Route::apiResource('/users', UserController::class);
// products
Route::apiResource('/products', ProductController::class);
Route::get('/latest-products', [ProductController::class, 'latestProduct']);
Route::post('product/upload-photo', [ProductController::class, 'uploadPhoto']);
//Categories
Route::apiResource('/categories', CategoryController::class);
//Banner
Route::get('/banners', [BannerController::class, 'index']);
