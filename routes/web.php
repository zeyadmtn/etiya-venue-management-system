<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/venues', [VenueController::class, 'index'])->name('venues');
    Route::get('/venue-page/{venue}', [VenueController::class, 'redirectToVenuePage'])->name('redirectToVenuePage');
    Route::post('/book-venue/{venue}', [BookingController::class, 'createBooking'])->name('createBooking');
    Route::get('/my-bookings', [BookingController::class, 'redirectToStudentBookingsPage'])->name('studentBookings');
    Route::post('/delete-booking/{booking}', [BookingController::class, 'deleteBooking'])->name('deleteBooking');
});

Route::middleware(['auth', 'EnsureUserIsStaff'])->group(function () {
    Route::get('/add-venue-page', [VenueController::class, 'redirectToAddVenuePage'])->name('admin.redirectToAddVenuePage');
    Route::post('/add-venue', [VenueController::class, 'addVenue'])->name('admin.addVenue');
    Route::post('/update-venue-page/{venue}', [VenueController::class, 'redirectToUpdateVenuePage'])->name('admin.redirectToUpdateVenuePage');
    Route::post('/update-venue/{venue}', [VenueController::class, 'updateVenue'])->name('admin.updateVenue');
    Route::post('/delete-venue/{venue}', [VenueController::class, 'deleteVenue'])->name('admin.deleteVenue');
});

require __DIR__.'/auth.php';
