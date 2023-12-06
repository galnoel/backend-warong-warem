<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\TablesController;
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

Route::post('register', [CustomersController::class, 'register']);
Route::post('login', [CustomersController::class, 'login']);
Route::post('createReservation', [ReservationsController::class, 'createReservation']);
Route::get('display', [ReservationsController::class, 'display']);
Route::put('status/{id}', [ReservationsController::class, 'updateStatus']);
Route::put('notes/{id}', [ReservationsController::class, 'updateNotes']);
Route::put('reservation-table/{id}', [ReservationsController::class, 'updateTable']);
Route::post('registerTable', [TablesController::class, 'registerTable']);