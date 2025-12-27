<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;

Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::middleware('auth:sanctum')->group(function () {

  // api semuanya disini

  Route::apiResource('/users', UserController::class);
  Route::apiResource('/products', ProductController::class);
  Route::apiResource('/customers', CustomerController::class);
  Route::apiResource('/orders', OrderController::class);
});
