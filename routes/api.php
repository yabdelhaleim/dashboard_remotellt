<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\TicketController;

/*
|--------------------------------------------------------------------------
| Remotelly API Routes
|--------------------------------------------------------------------------
*/

// --- Products ---
Route::get('/products',                       [ProductController::class, 'index']);
Route::get('/products/{slug}',                [ProductController::class, 'show']);
Route::post('/products',                      [ProductController::class, 'store']);
Route::put('/products/{id}',                  [ProductController::class, 'update']);
Route::delete('/products/{id}',              [ProductController::class, 'destroy']);
Route::post('/products/{id}/packages',        [ProductController::class, 'addPackage']);
Route::put('/packages/{id}',                  [ProductController::class, 'updatePackage']);
Route::delete('/packages/{id}',              [ProductController::class, 'removePackage']);

// --- Bookings ---
Route::get('/bookings/available-dates',       [BookingController::class, 'availableDates']);
Route::get('/bookings/available-slots',       [BookingController::class, 'availableSlots']);
Route::get('/bookings',                       [BookingController::class, 'index']);
Route::post('/bookings',                      [BookingController::class, 'store']);
Route::patch('/bookings/{id}/status',         [BookingController::class, 'updateStatus']);
Route::patch('/bookings/{id}/link',           [BookingController::class, 'updateLink']);
Route::delete('/bookings/{id}',              [BookingController::class, 'destroy']);

// --- Leads ---
Route::get('/leads',                          [LeadController::class, 'index']);
Route::post('/leads',                         [LeadController::class, 'store']);
Route::patch('/leads/{id}/status',            [LeadController::class, 'updateStatus']);
Route::delete('/leads/{id}',                 [LeadController::class, 'destroy']);

// --- Tickets ---
Route::get('/tickets',                        [TicketController::class, 'index']);
Route::post('/tickets',                       [TicketController::class, 'store']);
Route::get('/tickets/track',                  [TicketController::class, 'track']);
Route::patch('/tickets/{id}/status',          [TicketController::class, 'updateStatus']);
Route::patch('/tickets/{id}/priority',        [TicketController::class, 'updatePriority']);
Route::patch('/tickets/{id}/reply',           [TicketController::class, 'addReply']);
Route::delete('/tickets/{id}',                [TicketController::class, 'destroy']);

// --- Dashboard Stats ---
Route::get('/stats',                          [LeadController::class, 'stats']);
