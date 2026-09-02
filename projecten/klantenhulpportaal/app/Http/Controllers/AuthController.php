<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ForgotPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

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
            ], 422));
    }

    public function logout(Request $request): void {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function forgotpassword(Request $request): void {
        $request->validate(['email' => ['required', 'email']]);

        Password::sendResetLink($request->only('email'));
    }

    public function resetpassword(Request $request): void {
        $request->validate([
            'token' => 'required',
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(10));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );

        if (!($status === Password::PasswordReset)){
            throw new HttpResponseException(response()->json([
                'message' => 'De token is verlopen. Vraag een nieuwe aan.'
            ], 422));
        }
    }

    public function me(Request $request): User {
        $user = Auth::user();

        return $user;
    }
}
