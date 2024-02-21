<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ClientController;
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

Route::get('token/generate', [AuthController::class, 'createToken']);

Route::resource('books', BookController::class)->only(['index', 'show']);

Route::resource('clients', ClientController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('clients', ClientController::class)->only(['store' , 'destroy']);

    Route::patch('books/{book}/borrow', [BookController::class, 'borrow']);

    Route::patch('books/{book}/return', [BookController::class, 'return']);

});