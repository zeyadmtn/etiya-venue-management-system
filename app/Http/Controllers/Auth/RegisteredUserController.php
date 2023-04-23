<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['required', 'string', 'max:20'],
            'user_id' => ['required', 'string', 'max:30'],
            'user_type' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'faculty' => $request->user_type === 'student' ? ['required', 'string', 'max:255', 'nullable'] : ['nullable'],
            'student_body' => $request->user_type === 'student' ? ['required', 'string', 'max:255', 'nullable'] : ['nullable'],
            'student_body_role' => $request->user_type === 'student' ? ['required', 'string', 'max:255', 'nullable'] : ['nullable']
        ]);


        if ($validated['user_type'] != 'student') {
            $validated['faculty'] = null;
            $validated['student_body'] = null;
            $validated['student_body_role'] = null;
        }

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
