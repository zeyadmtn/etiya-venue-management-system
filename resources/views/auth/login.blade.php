    <!-- Session Status -->

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <div class="h-screen flex">
        <div class="flex w-1/2 bg-gradient-to-tr from-red-500 to-utm-maroon i justify-around items-center">
            <div>
                <h1 class="text-white font-bold text-4xl font-sans">Etiya Venue Management</h1>
                <p class="text-white mt-1">A brand new venue booking system made by Etiya!</p>
                <button type="submit" class="block w-28 bg-white text-indigo-800 mt-4 py-2 rounded-2xl font-bold mb-2">Read More</button>
            </div>
        </div>
        <div class="flex w-1/2 justify-center items-center ">
            <form class=" w-1/2" method="POST" action="{{ route('login') }}">
                @csrf
                <h1 class=" text-gray-800 font-bold text-2xl mb-1">Welcome back!</h1>
                <p class="text-sm font-normal text-gray-600 mb-7">Login to your account or create a new account.</p>
                <div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                    <input class="pl-2 border-transparent focus:border-transparent focus:ring-0  w-full" type="text" name="email" id="" placeholder="Email Address" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                </div>
                <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                    <input class="pl-2 border-transparent focus:border-transparent focus:ring-0 " type="text" name="password" id="" placeholder="Password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                </div>
                <div class=" w-full flex justify-between mt-2 ml-2">
                    <div>
                        <input type="checkbox" name="remember-me">
                        <label for="remember-me" class="text-sm ml-1">Remember me</label>
                    </div>
                    <span class="text-sm text-blue-500 cursor-pointer">Forgot password?</span>
                </div>
                <button type="submit" class="block w-full bg-red-700 mt-4 py-2 rounded-2xl text-white font-semibold mb-2">Login</button>
                <div class="flex flex-col text-center justify-center items-center mt-5">
                    <span class="text-sm ml-2 hover:text-blue-500 cursor-pointer">Don't have an account? <a href="{{route('register')}}" class="text-blue-500">Sign up!</a> </span>
                </div>
            </form>
        </div>
    </div>