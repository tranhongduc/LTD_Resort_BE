<?php

use App\Http\Controllers\API\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\AdminController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// customer
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customer/{id}',[CustomerController::class, 'show']);
Route::get('/customer-search/{search}', [CustomerController::class, 'searchByParams']);
Route::get('/customer-Find/{id}',[CustomerController::class, 'customerFindID']);
Route::post('/register-Cutomer',[CustomerController::class, 'registerCustomer']);
Route::get('/customer-Edit/{id}',[CustomerController::class, 'edit']);
Route::post('/customer-Update/{id}',[CustomerController::class, 'update']);
//employee
Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/employee/{id}',[EmployeeController::class, 'show']);
Route::get('/employee-Search/{search}', [EmployeeController::class, 'searchByParams']);
Route::get('/employee-Find/{id}',[EmployeeController::class, 'employeeFindID']);
Route::post('/employee-Store',[EmployeeController::class, 'store']);
Route::get('/employee-Edit/{id}',[EmployeeController::class, 'edit']);
Route::post('/employee-Update/{id}',[EmployeeController::class, 'update']);
//Admin
Route::get('/admins', [AdminController::class, 'index']);
Route::get('/admin/{id}',[AdminController::class, 'show']);
Route::get('/admin-Search/{search}', [AdminController::class, 'searchByParams']);
Route::get('/admin-Find/{id}',[AdminController::class, 'adminFindID']);
Route::get('/admin-Edit/{id}',[AdminController::class, 'edit']);
Route::post('/admin-Update/{id}',[AdminController::class, 'update']);
// Room Types
Route::get('/list-room-types', [RoomController::class, 'index']);
Route::get('/highest-price-room-type', [RoomController::class, 'getHighestPrice']);
Route::get('/smallest-size-room-type', [RoomController::class, 'getSmallestRoomSize']);
Route::get('/biggest-size-room-type', [RoomController::class, 'getBiggestRoomSize']);
Route::get('/list-room-type-names', [RoomController::class, 'getListRoomTypeName']);
Route::get('/bedroom-type-names', [RoomController::class, 'getBedroomTypeNames']);
Route::get('/room-type-names', [RoomController::class, 'getRoomTypeNames']);
Route::get('/room-type/{id}', [RoomController::class, 'show']);
Route::get('/find-room-type', [RoomController::class, 'findRoomType']);
Route::post('/filter-room-type', [RoomController::class, 'filterRoomType']);

// Services
Route::get('/list-services', [ServiceController::class, 'index']);
Route::get('/service/{id}', [ServiceController::class, 'show']);
Route::get('/lowest-price-service', [ServiceController::class, 'getLowestPrice']);
Route::get('/highest-price-service', [ServiceController::class, 'getHighestPrice']);
Route::post('/filter-service', [ServiceController::class, 'filterService']);
// Accounts
Route::get('/accounts', [AccountController::class, 'index']);
Route::get('/accounts/find/{username}', [AccountController::class, 'find']);

// Route::get('/customer', [AccountController::class, 'showCustomer']);

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
