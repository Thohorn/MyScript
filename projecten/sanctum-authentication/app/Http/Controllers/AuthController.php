<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
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
        if(Auth::hasUser()){
            $user = Auth::user();

            $me = [
                'name' => $user['name'],
                'email' => $user['email'],
            ];

            return $me;
        };
    }
}
