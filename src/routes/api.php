<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('sales/{id}', [SaleController::class, 'listBySellerId']);
Route::post('sales', [SaleController::class, 'store']);
Route::get('sales-report', [SaleController::class, 'salesReport']);
Route::get('sellers', [SellerController::class, 'index']);
Route::post('sellers', [SellerController::class, 'store']);