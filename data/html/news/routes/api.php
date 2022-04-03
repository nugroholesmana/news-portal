<?php

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


Route::GET('/get-admin-list', [App\Http\Controllers\api\APIAdminController::class, 'GetAdminList']);
Route::POST('/admin/add', [App\Http\Controllers\api\APIAdminController::class, 'StoreAdmin']);
Route::PATCH('/admin/edit', [App\Http\Controllers\api\APIAdminController::class, 'UpdateAdmin']);
Route::GET('/admin/get-data', [App\Http\Controllers\api\APIAdminController::class, 'GetData']);
Route::DELETE('/admin/delete', [App\Http\Controllers\api\APIAdminController::class, 'DeleteAdmin']);

Route::GET('/get-artikel-list', [App\Http\Controllers\api\APIArtikelController::class, 'GetArtikelList']);
Route::POST('/artikel/add', [App\Http\Controllers\api\APIArtikelController::class, 'StoreArtikel']);
Route::POST('/artikel/edit', [App\Http\Controllers\api\APIArtikelController::class, 'UpdateArtikel']);
Route::GET('/artikel/get-data', [App\Http\Controllers\api\APIArtikelController::class, 'GetData']);
Route::DELETE('/artikel/delete', [App\Http\Controllers\api\APIArtikelController::class, 'DeleteArtikel']);