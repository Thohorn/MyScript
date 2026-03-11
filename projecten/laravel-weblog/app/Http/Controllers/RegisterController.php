<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ]);

        $validated['password'] = bcrypt($validated['password']);

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
