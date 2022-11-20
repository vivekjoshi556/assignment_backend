<?php

use App\Models\Seat;
use App\Models\Coach;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

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

Route::get('/seats', [BookingController::class, "getSeats"]);
Route::get('/bookings', [BookingController::class, "getBookings"]);
Route::post('/bookSeats', [BookingController::class, "bookSeats"]);

Route::get('/resetDB', function() {
    Coach::where("id", "<", "12")
        ->update(["left" => 7]);

    Coach::where("id", "12")
        ->update(["left" => 3]);

    Seat::where("status", 1)
        ->update(["status" => 0]);

    DB::table("bookings")->truncate();

    return response()->json([
        "type" => "success",
        "msg" => "Database Seeded Successfully."
    ]);
});