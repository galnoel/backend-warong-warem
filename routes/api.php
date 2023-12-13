<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\TablesController;        
use App\Http\Controllers\UsersController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [UsersController::class, 'register']);
Route::post('testLogin', [UsersController::class, 'testLogin']);
Route::post('/login', [UsersController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', [UsersController::class, 'userRole']);
Route::middleware('jwt.auth')->get('/user', [UsersController::class, 'userRole']);
Route::middleware('jwt.auth')->post('/logout', [UsersController::class, 'logout']);
// Other protected routes for different roles handled within UserController


Route::post('registercustomer', [CustomersController::class, 'register']);
//Route::post('login', [CustomersController::class, 'login']);

Route::post('createReservation', [ReservationsController::class, 'createReservation'])->middleware('auth');
Route::post('createDummyReservation', [ReservationsController::class, 'createDummyReservation']);
Route::post('store', [ReservationsController::class,'store']);
Route::get('display-customer/{id}', [ReservationsController::class, 'display_customer']);
Route::put('status/{id}', [ReservationsController::class, 'updateStatus']);
Route::put('notes/{id}', [ReservationsController::class, 'updateNotes']);
Route::put('reservation-table/{id}', [ReservationsController::class, 'updateTable']);
Route::put('reschedule/{id}', [ReservationsController::class, 'reschedule']);
Route::get('reservation-list', [ReservationsController::class, 'getUserReservations']);


Route::post('registerTable', [TablesController::class, 'registerTable']);
Route::post('createReservation', [ReservationsController::class, 'createReservation']);
Route::put('tableStatus/{id}', [TablesController::class, 'updateStatus']);
Route::put('tableCapacity/{id}', [TablesController::class, 'updateCapacity']);