<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Venue;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function createBooking(Request $request, Venue $venue) {
       $validated = $request->validate([
         'start_date' => 'required|date|after_or_equal:tomorrow',
         'end_date' => 'required|date|after_or_equal:start_date',
      ]);

      $startDate = new DateTime($validated['start_date']);
      $endDate = new DateTime($validated['end_date']);
      $numDays = $endDate->diff($startDate)->days + 1;

      $validated['num_of_days_booked'] = $numDays;
      $validated['total_payment'] = $venue->deposit_price + ($venue->daily_rate * $numDays);

      $validated['student_id'] = Auth::user()->id;
      $validated['venue_id'] = $venue->id;
      $validated['deposit_price'] = $venue->deposit_price;
      $validated['status'] = 'Pending';
      
      $booking = Booking::create($validated);

      return redirect()->route('studentBookings');
     }

   public function deleteBooking(Request $request, Booking $booking)
   {
      $booking->delete();
      return redirect()->back();
   }

     public function redirectToStudentBookingsPage(Request $request){

      $bookings = Booking::where('student_id', Auth::user()->id)->get();
      return view('student-bookings', [
         'bookings' => $bookings
      ]);
     }
}
