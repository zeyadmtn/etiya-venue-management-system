<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Welcome, {{Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-12 bg-red-50 flex items-center justify-center">
        @if (Auth::user()->user_type == 'staff')
        <a href="{{route('venues')}}" class="bg-orange-600 text-white rounded-3xl w-1/5 text-center px-5 py-3 hover:bg-orange-400 cursor-pointer">
            Manage Venues
        </a>
        @else
        <a href="{{route('venues')}}" class="bg-orange-600 text-white rounded-3xl w-1/5 text-center px-5 py-3 hover:bg-orange-400 cursor-pointer">
            View Venues
        </a>
        <a href="{{route('studentBookings')}}" class="bg-orange-600 text-white rounded-3xl w-1/5 text-center px-5 py-3 hover:bg-orange-400 cursor-pointer">
            My Bookings
        </a>
        @endif
    </div>
</x-app-layout>