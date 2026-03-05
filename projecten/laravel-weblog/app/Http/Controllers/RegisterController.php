<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $validated['password'] = bcrypt($validated['password']);

        // Attempt to create a user, if you do not succeed throw errors
        $user = User::create([
            'username' => $validated['username'],
            'password' => $validated['password'],
            'email' => $validated['email'],
            'role' => "user",
            'premium' => false,
        ]);

        Auth::login($user);

        return redirect()->route('users.dashboard');
    }
}
