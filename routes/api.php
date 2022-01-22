<?php

use App\Http\Controllers\AlibabaOrdersController;
use App\Http\Controllers\ExpressController;
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
Route::post('/upload/alibabaOrder', [AlibabaOrdersController::class, 'import']);
Route::post('/upload/express', [ExpressController::class, 'import']);
Route::get('/expresses', [ExpressController::class, 'index']);
Route::get('/alibabaOrders', [AlibabaOrdersController::class, 'index']);
Route::get('/alibabaOrder', [AlibabaOrdersController::class, 'getOrderByPhone']);
Route::get('/express', [ExpressController::class, 'getExpressByPhone']);

