<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\frontend\NewsController::class, 'index']);
Route::get('/detail/{id}', [App\Http\Controllers\frontend\NewsController::class, 'detail']);


Route::get('/login', [App\Http\Controllers\backend\AuthenticationController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\backend\AuthenticationController::class, 'action_login']);


Route::middleware(['auth'])->group(function() {
    Route::get('/admin', [App\Http\Controllers\backend\AdminController::class, 'index']);
    Route::get('/artikel', [App\Http\Controllers\backend\ArtikelController::class, 'index']);
    Route::post('/logout', [App\Http\Controllers\backend\AuthenticationController::class, 'logout']);
});