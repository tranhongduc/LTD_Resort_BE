<?php

use App\Http\Controllers\API\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\ServiceController;

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

// Public route
Route::group([
    'middleware' => ['force.json.response', 'api'],
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

// Auth API
Route::group([
    'middleware' => ['force.json.response', 'api', 'api.auth'],
    'prefix' => 'auth',
], function ($router) {
    // Authenticate
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);

    // Account
    Route::get('/accounts', [AccountController::class, 'index']);
    Route::get('/accounts/search/{username}', [AccountController::class, 'searchByUsername']);
    Route::get('/accounts/{id}', [AccountController::class, 'show']);
    Route::patch('/accounts/{id}', [AccountController::class, 'updateAvatar']);

    // Room Types
    Route::get('/room-types', [RoomController::class, 'index']);
    Route::get('/room-types/lowest-price', [RoomController::class, 'getLowestPrice']);
    Route::get('/room-types/highest-price', [RoomController::class, 'getHighestPrice']);
    Route::get('/room-types/smallest-size', [RoomController::class, 'getSmallestRoomSize']);
    Route::get('/room-types/biggest-size', [RoomController::class, 'getBiggestRoomSize']);
    Route::get('/room-types/names', [RoomController::class, 'getListRoomTypeName']);
    Route::get('/room-types/bedroom-names', [RoomController::class, 'getBedroomTypeNames']);
    Route::get('/room-types/room-names', [RoomController::class, 'getRoomTypeNames']);
    Route::post('/room-types/filter', [RoomController::class, 'filterRoomType']);
    Route::get('/room-types/{id}', [RoomController::class, 'show']);

    // Services
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/lowest-price', [ServiceController::class, 'getLowestPrice']);
    Route::get('/services/highest-price', [ServiceController::class, 'getHighestPrice']);
    Route::get('services/names', [ServiceController::class, 'getListServiceNames']);
    Route::post('services/filter', [ServiceController::class, 'filterService']);
    Route::get('/services/{id}', [ServiceController::class, 'show']);
});

// Customer API
Route::group([
    'middleware' => ['force.json.response', 'api', 'api.auth', 'auth.customer'],
    'prefix' => 'customer',
], function ($router) {
    Route::get('/list', [CustomerController::class, 'index']);
    Route::get('/{id}', [CustomerController::class, 'show']);
    Route::get('/account/{account_id}', [CustomerController::class, 'getCustomerByAccountId']);
    Route::get('/ranking/{id}', [CustomerController::class, 'getRankingNameByAccountId']);
    Route::patch('/{id}', [CustomerController::class, 'update']);

});

// Employee API
Route::group([
    'middleware' => ['force.json.response', 'api', 'api.auth', 'auth.employee'],
    'prefix' => 'employee',
], function ($router) {

});

// Admin API
Route::group([
    'middleware' => ['force.json.response', 'api', 'api.auth', 'auth.admin'],
    'prefix' => 'admin',
], function ($router) {
    
});
