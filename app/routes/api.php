<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Event\EventController;
use App\Http\Controllers\Api\Booking\BookingController;
use App\Http\Controllers\Api\BookingDiscount\BookingDiscountController;

Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/users/login', [AuthController::class, 'login']);




Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/user', [EventController::class, 'userIndex']);
    Route::get('/events/{event}', [EventController::class, 'show']);
    Route::post('/events', [EventController::class, 'store']);
    Route::put('/events/{event}', [EventController::class, 'update']);
    Route::delete('/events/{event}', [EventController::class, 'delete']);

    Route::post('/booking', [BookingController::class, 'store']);
    Route::get('/booking/history', [BookingController::class, 'history']);

    Route::get('/bookingDiscount', [BookingDiscountController::class, 'index']);
    Route::post('/bookingDiscount', [BookingDiscountController::class, 'store']);
    Route::put('/bookingDiscount/{id}', [BookingDiscountController::class, 'update']);
    Route::delete('/bookingDiscount/{id}', [BookingDiscountController::class, 'delete']);
});

