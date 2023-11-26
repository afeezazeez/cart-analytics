<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Shop\CartController;
use App\Http\Controllers\Api\Shop\CheckoutController;
use App\Http\Controllers\Api\Shop\ProductController;
use App\Http\Controllers\Api\Shop\RemovedCartItemController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {


   Route::prefix('auth')->group(function () {
        Route::post('login',[AuthController::class,'store']);
        Route::delete('logout', [AuthController::class,'delete'])->middleware('auth:api');
    });


    Route::middleware(['auth:api'])->group(function () {

        Route::prefix('shop')->group(function () {

            Route::get('products',ProductController::class);

            Route::prefix('carts')->group(function () {
                Route::post('items', [CartController::class,'store']);
                Route::delete('items', [CartController::class,'destroy']);
                Route::post('checkout', CheckoutController::class);
                Route::get('removed-items', RemovedCartItemController::class)->middleware('admin');
            });

        });
    });

});
