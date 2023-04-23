@props(['venues' => []])
<x-app-layout>
    <div class="py-12 flex flex-col space-y-5 items-center justify-center px-16 bg-utm-maroon bg-opacity-5">
        @if (Auth::user()->user_type == 'staff')
        <a href=" {{route('admin.redirectToAddVenuePage')}}" class="bg-green-500 rounded-2xl w-1/6 text-center text-white hover:bg-green-400 cursor-pointer">
            Add Venue
        </a>
        @endif

        @foreach ($venues as $venue)

        <div class="shadow-lg bg-white pr-20 p-2 w-full rounded-3xl flex flex-row space-x-5">
            @isset($venue->images[0])
            <img src="data:image/jpeg;base64,{{ base64_encode($venue->images[0]) }}" alt="{{ $venue->name }}" class="max-w-xs rounded-l-3xl rounded-r-3xl">
            @else
            <div class="h-auto w-32 bg-gray-300 justify-center text-center flex "><span class="my-auto text-2xl opacity-20">X</span></div>
            @endisset
            <div class="py-5 text-xl flex flex-row w-full">
                <div class="flex flex-col py-5 space-y-6  text-utm-maroon">
                    <div class="flex flex-row space-x-3 text-center justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22">
                            <path d="M2 12H4V21H2V12ZM5 14H7V21H5V14ZM16 8H18V21H16V8ZM19 10H21V21H19V10ZM9 2H11V21H9V2ZM12 4H14V21H12V4Z" fill="rgb(239, 68, 68)"></path>
                        </svg>
                        <div> {{$venue->name}} </div>
                    </div>

                    <div class="flex flex-row space-x-3 ">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="22" height="22">
                            <path fill="rgb(239, 68, 68)" d="M12 11C14.7614 11 17 13.2386 17 16V22H15V16C15 14.4023 13.7511 13.0963 12.1763 13.0051L12 13C10.4023 13 9.09634 14.2489 9.00509 15.8237L9 16V22H7V16C7 13.2386 9.23858 11 12 11ZM5.5 14C5.77885 14 6.05009 14.0326 6.3101 14.0942C6.14202 14.594 6.03873 15.122 6.00896 15.6693L6 16L6.0007 16.0856C5.88757 16.0456 5.76821 16.0187 5.64446 16.0069L5.5 16C4.7203 16 4.07955 16.5949 4.00687 17.3555L4 17.5V22H2V17.5C2 15.567 3.567 14 5.5 14ZM18.5 14C20.433 14 22 15.567 22 17.5V22H20V17.5C20 16.7203 19.4051 16.0796 18.6445 16.0069L18.5 16C18.3248 16 18.1566 16.03 18.0003 16.0852L18 16C18 15.3343 17.8916 14.694 17.6915 14.0956C17.9499 14.0326 18.2211 14 18.5 14ZM5.5 8C6.88071 8 8 9.11929 8 10.5C8 11.8807 6.88071 13 5.5 13C4.11929 13 3 11.8807 3 10.5C3 9.11929 4.11929 8 5.5 8ZM18.5 8C19.8807 8 21 9.11929 21 10.5C21 11.8807 19.8807 13 18.5 13C17.1193 13 16 11.8807 16 10.5C16 9.11929 17.1193 8 18.5 8ZM5.5 10C5.22386 10 5 10.2239 5 10.5C5 10.7761 5.22386 11 5.5 11C5.77614 11 6 10.7761 6 10.5C6 10.2239 5.77614 10 5.5 10ZM18.5 10C18.2239 10 18 10.2239 18 10.5C18 10.7761 18.2239 11 18.5 11C18.7761 11 19 10.7761 19 10.5C19 10.2239 18.7761 10 18.5 10ZM12 2C14.2091 2 16 3.79086 16 6C16 8.20914 14.2091 10 12 10C9.79086 10 8 8.20914 8 6C8 3.79086 9.79086 2 12 2ZM12 4C10.8954 4 10 4.89543 10 6C10 7.10457 10.8954 8 12 8C13.1046 8 14 7.10457 14 6C14 4.89543 13.1046 4 12 4Z"></path>
                        </svg>

                        <div> {{$venue->capacity}} <span class="text-xs text-gray-500"> pax</span></div>
                    </div>
                    <div class="flex flex-row space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 96 960 960" width="22" height="24" class="self-center">
                            <path fill="rgb(239, 68, 68)" d="M433 935v-86q-61-13-100-55t-52-106l112-42q6 42 37.5 68.5T490 741q36 0 52.5-15t16.5-35q0-21-24-40.5T461 616q-78-26-117.5-67T304 451q0-47 29-88.5T433 301v-84h97v84q74 16 104 65.5t33 62.5l-106 42q-7-24-31-43t-50-19q-27 0-42 11.5T423 445q0 17 15 31.5t91 41.5q76 26 112.5 66.5T678 691q-1 63-39.5 106T530 853v82h-97Z" />
                        </svg>
                        <div> {{$venue->daily_rate}} <span class="text-xs text-gray-500"> /day</span>
                        </div>
                    </div>
                </div>
                <div class="justify-end items-center flex flex-grow">
                    @if (Auth::user()->user_type == 'staff')
                    <form action=" {{ route('admin.redirectToUpdateVenuePage', $venue) }}" method="POST">
                        @csrf
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="ml-auto cursor-pointer">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path d="M16.626 3.132L9.29 10.466l.008 4.247 4.238-.007 7.331-7.332A9.957 9.957 0 0 1 22 12c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2c1.669 0 3.242.409 4.626 1.132zm3.86-1.031l1.413 1.414-9.192 9.192-1.412.003-.002-1.417L20.485 2.1z" fill="rgba(59,130,246,1)" />
                            </svg>
                        </button>
                    </form>
                    @endif
                    <form action="{{route('redirectToVenuePage', $venue)}}">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" height="40" viewBox="0 96 960 960" width="40">
                                <path fill="#43DF3D" d="M480 656q-17 0-28.5-11.5T440 616q0-17 11.5-28.5T480 576q17 0 28.5 11.5T520 616q0 17-11.5 28.5T480 656Zm-160 0q-17 0-28.5-11.5T280 616q0-17 11.5-28.5T320 576q17 0 28.5 11.5T360 616q0 17-11.5 28.5T320 656Zm320 0q-17 0-28.5-11.5T600 616q0-17 11.5-28.5T640 576q17 0 28.5 11.5T680 616q0 17-11.5 28.5T640 656ZM480 816q-17 0-28.5-11.5T440 776q0-17 11.5-28.5T480 736q17 0 28.5 11.5T520 776q0 17-11.5 28.5T480 816Zm-160 0q-17 0-28.5-11.5T280 776q0-17 11.5-28.5T320 736q17 0 28.5 11.5T360 776q0 17-11.5 28.5T320 816Zm320 0q-17 0-28.5-11.5T600 776q0-17 11.5-28.5T640 736q17 0 28.5 11.5T680 776q0 17-11.5 28.5T640 816ZM186.666 976q-27 0-46.833-19.833T120 909.334V309.333q0-27 19.833-46.833 19.833-19.834 46.833-19.834h56.667V176h70v66.666h333.334V176h70v66.666h56.667q27 0 46.833 19.834Q840 282.333 840 309.333v600.001q0 27-19.833 46.833T773.334 976H186.666Zm0-66.666h586.668V489.333H186.666v420.001Z" />
                            </svg>
                            <span class="text-xs text-gray-500">Book</span>

                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>