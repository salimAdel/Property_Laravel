<?php

use App\Http\Controllers\api\Dashboard\AdvertisementController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\Dashboard\CategoryController;
use App\Http\Controllers\api\Dashboard\OfferTypeController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});




Route::group([
    'middleware' => 'api',
    'prefix' => 'Advertisement'
],function ($router){
    Route::get('/', [AdvertisementController::class, 'index']);
    Route::post('/', [AdvertisementController::class, 'store']);
    Route::get('/{id}', [AdvertisementController::class, 'show']);
    Route::post('/{id}/edit', [AdvertisementController::class, 'update']);
    Route::get('/{id}/delete', [AdvertisementController::class, 'destroy']);
});




Route::group([
    'middleware' => 'api',
    'prefix' => 'OfferType'
],function ($router){
    Route::get('/', [OfferTypeController::class, 'index']);
    Route::post('/', [OfferTypeController::class, 'store']);
    Route::get('/{id}', [OfferTypeController::class, 'show']);
    Route::post('/{id}/edit', [OfferTypeController::class, 'update']);
    Route::get('/{id}/delete', [OfferTypeController::class, 'destroy']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'Category'
],function ($router){
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::post('/{id}/edit', [CategoryController::class, 'update']);
    Route::get('/{id}/delete', [CategoryController::class, 'destroy']);
});
