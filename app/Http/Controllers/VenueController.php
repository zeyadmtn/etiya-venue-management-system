<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $venues = Venue::all();

        foreach ($venues as $venue) {
            $images = json_decode($venue->images, true);
            if ($images) {
                $decodedImages = array_map(function ($image) {
                    $image = base64_decode($image);
                    return $image;
                }, $images);
                $venue->images = $decodedImages;
            } else {
                $venue->images = null;
                continue;
            }
        }



        foreach ($venues as $venue) {
            // Create an empty array to store the booked dates
            $bookedDates = [];

            // Loop through each booking for this venue
            foreach ($venue->bookings as $booking) {
                // Get the start and end dates for this booking
                $startDate = Carbon::parse($booking->start_date);
                $endDate = Carbon::parse($booking->end_date);

                // Loop through each day of the booking, and add it to the array
                for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                    $bookedDates[] = $date->format('d-m-Y');
                }
            }

            // Sort the array of booked dates in ascending order
            sort($bookedDates);

            // Join the array of booked dates into a string, with each date separated by a space
            $bookedDatesString = implode(' ', $bookedDates);

            // Add the booked dates string to the venue object
            $venue->bookedDates = $bookedDatesString;
        }

        // Now $venues array contains the 'bookedDates' string property for each Venue



        return view('venues', [
            'venues' => $venues
        ]);
    }

    public function redirectToAddVenuePage()
    {
        return view('admin-add-venue');
    }

    public function redirectToUpdateVenuePage(Request $request, Venue $venue)
    {
        $images = json_decode($venue->images, true);
        if ($images) {
            $decodedImages = array_map(function ($image) {
                $image = base64_decode($image);
                return $image;
            }, $images);
            $venue->images = $decodedImages;
        } else {
            $venue->images = null;
        }

        return view('admin-update-venue', [
            'venue' => $venue
        ]);
    }

    public function redirectToVenuePage(Request $request, Venue $venue)
    {
        $images = json_decode($venue->images, true);
        if ($images) {
            $decodedImages = array_map(function ($image) {
                $image = base64_decode($image);
                return $image;
            }, $images);
            $venue->images = $decodedImages;
        } else {
            $venue->images = null;
        }

        $bookedDates = [];

        // Loop through each booking for this venue
        foreach ($venue->bookings as $booking) {
            // Get the start and end dates for this booking
            $startDate = Carbon::parse($booking->start_date);
            $endDate = Carbon::parse($booking->end_date);

            // Loop through each day of the booking, and add it to the array
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $bookedDates[] = $date->format('d-m-Y');
            }
        }

        // Sort the array of booked dates in ascending order
        sort($bookedDates);

        // Join the array of booked dates into a string, with each date separated by a space
        $bookedDatesString = implode(' ', $bookedDates);

        // Add the booked dates string to the venue object
        $venue->bookedDates = $bookedDatesString;

        return view('venue-page', [
            'venue' => $venue
        ]);
    }



    public function addVenue(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required|max:255',
            'capacity' => 'numeric|required',
            'equipment' => 'string|nullable|max:255',
            'deposit_price' => 'numeric|nullable',
            'daily_rate' => 'numeric|required',
            'images.*' => 'image|mimes:jpeg,png|max:2048|nullable',
            'images' => 'max:3|nullable'
        ]);


        $images = [];
        if (isset($validated['images'])) {
            foreach ($validated['images'] as $image) {
                array_push($images, base64_encode(file_get_contents($image)));
            }
        }

        $validated['images'] = json_encode($images);

        $venue = Venue::create($validated);

        return redirect()->route('venues');
    }

    public function updateVenue(Request $request, Venue $venue)
    {
        $validated = $request->validate([
            'name' => 'string|required|max:255',
            'capacity' => 'numeric|required',
            'equipment' => 'string|nullable|max:255',
            'deposit_price' => 'numeric|nullable',
            'daily_rate' => 'numeric|required',
            'images.*' => 'image|mimes:jpeg,png|max:2048|nullable',
            'images' => 'max:3|nullable'
        ]);

        $images = [];
        if (isset($validated['images'])) {
            foreach ($validated['images'] as $image) {
                array_push($images, base64_encode(file_get_contents($image)));
            }
            $validated['images'] = json_encode($images);
        }

        $venue->update($validated);

        return redirect()->route('venues');
    }

    public function deleteVenue(Request $request, Venue $venue)
    {
        $venue->delete();
        return redirect()->route('venues');
    }
}
