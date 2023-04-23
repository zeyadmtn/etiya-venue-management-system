@props(['bookings' => []])
<x-app-layout>
    <div class="py-12 bg-red-50 flex flex-col space-y-5 items-center justify-center px-16">
        @if (Auth::user()->user_type == 'staff')
        <a href="{{route('venues')}}" class="bg-green-500 rounded-2xl w-1/6 text-center text-white hover:bg-green-400 cursor-pointer">
            Create Booking
        </a>
        @endif

        @if ($bookings->isEmpty())
        <div>
            No bookings found.
        </div>
        @endif
        @foreach ($bookings as $booking)

        <div class="bg-blue-200 px-20 w-full rounded-md flex flex-row space-x-5">
            <div class="flex flex-col py-5 space-y-3">
                <span>Name: {{$booking->venue->name}}</span>
                <span>Start Date: {{$booking->start_date}}</span>
                <span>End Date: {{$booking->end_date}}</span>
                <span>Number of Days Booked: {{$booking->num_of_days_booked}}</span>
                <span>Total Payment: {{$booking->total_payment}}</span>
                <span>Deposit: RM {{$booking->deposit_price}}</span>
                <span>Approval Status: {{$booking->status}}</span>

            </div>
            <div class="flex-grow justify-center items-center flex">
                <form action=" {{ route('deleteBooking', $booking) }}" method="POST">
                    @csrf
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM9 11V17H11V11H9ZM13 11V17H15V11H13ZM9 4V6H15V4H9Z" fill="rgba(255,0,0,1)"></path>
                        </svg>
                    </button>
                </form>

            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>