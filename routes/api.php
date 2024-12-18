<?php

use App\Http\Controllers\api\Dashboard\AdvertisementController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\Dashboard\AppInfoController;
use App\Http\Controllers\api\Dashboard\CategoryController;
use App\Http\Controllers\api\Dashboard\CompanyController;
use App\Http\Controllers\api\Dashboard\CountryController;
use App\Http\Controllers\api\Dashboard\OfferTypeController;
use App\Http\Controllers\api\Dashboard\OwnershipController;
use App\Http\Controllers\api\Dashboard\PartnerController;
use App\Http\Controllers\api\Dashboard\PrivilegeController;
use App\Http\Controllers\api\Dashboard\RealEstateEvaluationController;
use App\Http\Controllers\api\Dashboard\RealEstateOfferController;
use App\Http\Controllers\api\Dashboard\RoleBasedPrivilegeController;
use App\Http\Controllers\api\Dashboard\RoleController;
use App\Http\Controllers\api\Dashboard\UploadeFileController;
use App\Http\Controllers\api\Dashboard\UserController;
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


/*
|--------------------------------------------------------------------------
| API JWT Authentication Start
|--------------------------------------------------------------------------
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
    Route::post('/update-profile', [AuthController::class, 'update']);
    Route::post('/rest-password', [AuthController::class, 'resetPassword']);
});
/*
|--------------------------------------------------------------------------
| API JWT Authentication End
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| API Dashboard Start
|--------------------------------------------------------------------------
*/
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'Company'
],function ($router){
    Route::get('/', [CompanyController::class, 'index']);
    Route::post('/', [CompanyController::class, 'store']);
    Route::get('/{id}', [CompanyController::class, 'show']);
    Route::post('/{id}/edit', [CompanyController::class, 'update']);
    Route::get('/{id}/delete', [CompanyController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'Role'
],function ($router){
    Route::get('/', [RoleController::class, 'index']);
    Route::post('/', [RoleController::class, 'store']);
    Route::get('/{id}', [RoleController::class, 'show']);
    Route::post('/{id}/edit', [RoleController::class, 'update']);
    Route::get('/{id}/delete', [RoleController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'Ownership'
],function ($router){
    Route::get('/', [OwnershipController::class, 'index']);
    Route::post('/', [OwnershipController::class, 'store']);
    Route::get('/{id}', [OwnershipController::class, 'show']);
    Route::post('/{id}/edit', [OwnershipController::class, 'update']);
    Route::get('/{id}/delete', [OwnershipController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'Partner'
],function ($router){
    Route::get('/', [PartnerController::class, 'index']);
    Route::post('/', [PartnerController::class, 'store']);
    Route::get('/{id}', [PartnerController::class, 'show']);
    Route::post('/{id}/edit', [PartnerController::class, 'update']);
    Route::get('/{id}/delete', [PartnerController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'User'
],function ($router){
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/{id}/edit', [UserController::class, 'update']);
    Route::get('/{id}/delete', [UserController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'Country'
],function ($router){
    Route::get('/', [CountryController::class, 'index']);
    Route::post('/', [CountryController::class, 'store']);
    Route::get('/{id}', [CountryController::class, 'show']);
    Route::post('/{id}/edit', [CountryController::class, 'update']);
    Route::get('/{id}/delete', [CountryController::class, 'destroy']);
});

Route::get('/Privilege' , [PrivilegeController::class, 'index'])->middleware(['api']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'RealEstateEvaluation'
],function ($router){
    Route::get('/', [RealEstateEvaluationController::class, 'index']);
    Route::post('/', [RealEstateEvaluationController::class, 'store']);
    Route::get('/{id}', [RealEstateEvaluationController::class, 'show']);
    Route::post('/{id}/edit', [RealEstateEvaluationController::class, 'update']);
    Route::get('/{id}/delete', [RealEstateEvaluationController::class, 'destroy']);
    Route::Post('/{id}/upload', [UploadeFileController::class,'UploadEvaluationFile']);
    Route::Post('/{id}/update_file', [UploadeFileController::class,'UpdateEvaluationFile']);
    Route::get('/{id}/delete_file', [UploadeFileController::class,'DeleteEvaluationFile']);

});

//test
Route::group([
    'middleware' => 'api',
    'prefix' => 'RealEstateOffer'
],function ($router){
    Route::get('/', [RealEstateOfferController::class, 'index']);
    Route::post('/', [RealEstateOfferController::class, 'store']);
    Route::get('/{id}', [RealEstateOfferController::class, 'show']);
    Route::post('/{id}/edit', [RealEstateOfferController::class, 'update']);
    Route::get('/{id}/delete', [RealEstateOfferController::class, 'destroy']);
    Route::Post('/{id}/upload', [UploadeFileController::class,'UploadOfferFile']);
    Route::Post('/{id}/update_file', [UploadeFileController::class,'UpdateOfferFile']);
    Route::get('/{id}/delete_file', [UploadeFileController::class,'DeleteOfferFile']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'RoleBasedPrivilege'
],function ($router){
    Route::get('/{role_Id}', [RoleBasedPrivilegeController::class, 'index']);
    Route::post('/{role_Id}/edit', [RoleBasedPrivilegeController::class, 'update']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'AppInfo'
],function ($router){
    Route::get('/', [AppInfoController::class, 'index']);
    Route::post('/', [AppInfoController::class, 'update']);
});
/*
|--------------------------------------------------------------------------
| API Dashboard End
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| API Client Start
|--------------------------------------------------------------------------
*/

Route::get('/Client/Advertisement', [\App\Http\Controllers\api\Client\AdvertisementController::class, 'index'])->middleware(['api']);
Route::get('/Client/AppInfo', [\App\Http\Controllers\api\Client\AppInfoController::class, 'index'])->middleware(['api']);
Route::get('/Client/Company', [\App\Http\Controllers\api\Client\CompanyController::class, 'index'])->middleware(['api']);
Route::get('/Client/OfferType', [\App\Http\Controllers\api\Client\OfferTypeController::class, 'index'])->middleware(['api']);
Route::get('/Client/Partner', [\App\Http\Controllers\api\Client\PartnerController::class, 'index'])->middleware(['api']);
Route::post('/Client/Ownership', [\App\Http\Controllers\api\Client\OwnershipController::class, 'store'])->middleware(['api']);
Route::post('/Client/RealEstateEvaluation', [\App\Http\Controllers\api\Client\RealEstateEvaluationController::class, 'store'])->middleware(['api']);
Route::Post('/Client/RealEstateEvaluation/{id}/upload', [UploadeFileController::class,'UploadEvaluationFile'])->middleware(['api']);
Route::get('/Client/RealEstateOffer', [\App\Http\Controllers\api\Client\RealEstateOfferController::class, 'index'])->middleware(['api']);
Route::post('/Client/RealEstateOffer', [RealEstateOfferController::class, 'store'])->middleware(['api']);
Route::Post('/Client/RealEstateOffer/{id}/upload', [UploadeFileController::class,'UploadOfferFile'])->middleware(['api']);
Route::get('/Client/RealEstateOffer/search', [\App\Http\Controllers\api\Client\RealEstateOfferController::class,'Search'])->middleware(['api']);
Route::get('/Client/RealEstateOffer/{id}', [\App\Http\Controllers\api\Client\RealEstateOfferController::class, 'show']);

/*
|--------------------------------------------------------------------------
| API Client End
|--------------------------------------------------------------------------
*/

Route::get('/test',[\App\Http\Controllers\api\Dashboard\testController::class,'test']);
