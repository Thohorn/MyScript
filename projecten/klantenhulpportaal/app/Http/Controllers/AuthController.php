<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['message' => 'Succesvol ingelogd']);;
        }

        throw new HttpResponseException(response()->json([
                'message' => 'De gegevens komen niet overeen met wat bij ons bekend is.'
            ], 422));;
    }

    public function me() {
        $user = Auth::user();

        return $user;
    }
}
