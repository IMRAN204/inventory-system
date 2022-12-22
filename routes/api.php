<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryMediaController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseTypeController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', function(){
    return User::with('role')->get();
});

Route::resource('category', CategoryController::class);
Route::resource('purchase-type', PurchaseTypeController::class);
Route::resource('expense-type', ExpenseTypeController::class);
Route::resource('expense', ExpenseController::class);
Route::resource('investment', InvestmentController::class);
Route::resource('delivery-media', DeliveryMediaController::class);
Route::resource('customer', CustomerController::class);
Route::resource('order', OrderController::class);
Route::resource('product', ProductController::class);

Route::get('invoice', [OrderController::class, 'invoice']);
