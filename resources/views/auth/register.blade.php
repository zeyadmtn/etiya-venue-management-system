<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" x-data="{ showStudentInputs: false }">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- User Id -->
        <div class="mt-4">
            <x-input-label for="user_id" :value="__('Student/Staff ID')" />
            <x-text-input id="user_id" class="block mt-1 w-full" type="text" name="user_id" :value="old('user_id')" required />
            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
        </div>


        <!-- User Type -->
        <div class="mt-4">
            <x-input-label for="user_type" :value="__('Account Type')" />
            <div class="flex flex-row space-x-5">
                <div class="flex flex-row space-x-2 mt-3">
                    <input type="radio" id="student" name="user_type" value="student" required @click="showStudentInputs = true">
                    <label for="student" class="text-sm">Student</label><br>
                </div>
                <div class="flex flex-row space-x-2 mt-3">
                    <input type="radio" id="staff" name="user_type" value="staff" @click="showStudentInputs = false">
                    <label for="staff" class="text-sm">Staff</label><br>
                </div>
            </div>
            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
        </div>


        <!-- Faculty -->
        <div class="mt-4" x-show="showStudentInputs">
            <x-input-label for="faculty" :value="__('Faculty')" />
            <x-text-input id="faculty" class="block mt-1 w-full" type="text" name="faculty" x-bind:required="showStudentInputs" />
            <x-input-error :messages="$errors->get('faculty')" class="mt-2" />
        </div>

        <!-- Student Body -->
        <div class="mt-4" x-show="showStudentInputs">
            <x-input-label for="student_body" :value="__('Student Body')" />
            <x-text-input id="student_body" class="block mt-1 w-full" type="text" name="student_body" x-bind:required="showStudentInputs" />
            <x-input-error :messages="$errors->get('student_body')" class="mt-2" />
        </div>

        <!-- Student Body Role -->
        <div class="mt-4" x-show="showStudentInputs">
            <x-input-label for="student_body_role" :value="__('Role/Position in Student Body')" />
            <x-text-input id="student_body_role" class="block mt-1 w-full" type="text" name="student_body_role" x-bind:required="showStudentInputs" />
            <x-input-error :messages="$errors->get('student_body_role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>