<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function authenticate(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['message' => 'Succesvol ingelogd', 'user' => Auth::user()]);
        }

        throw new HttpResponseException(response()->json([
                'message' => 'De gegevens komen niet overeen met wat bij ons bekend is.'
            ], 422));;
    }

    public function logout(Request $request): void{
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function me(Request $request): User {
        $user = Auth::user();

        return $user;
    }
}
