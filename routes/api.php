<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\RegisteredUserController;
use App\Http\Controllers\Api\ProductOwnerController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\Rules\Password;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;


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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [RegisteredUserController::class, 'register']);
Route::get('/products', [ProductOwnerController::class, 'products']);
Route::get('/feedbacks', [FeedbackController::class, 'feedbacks']);


Route::get('/indexUsers', [AdminController::class, 'indexUsers']);
Route::get('/indexUsers/{id}', [AdminController::class, 'showUsers']);
Route::delete('/indexUsers/{id}', [AdminController::class, 'destroyUsers']);

Route::middleware('auth:sanctum','verified')->get('/user', function (Request $request) {
    // return $request->user();
    // Route::get('/products', [ProductOwnerController::class, 'products']);
});


