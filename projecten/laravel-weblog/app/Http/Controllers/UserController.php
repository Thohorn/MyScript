<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'incorrect' => 'De inloggegevens zijn onjuist.',
            ]);    
        }
        
        $request->session()->regenerate();

        
        return redirect()->route('users.index');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->where('user_id', Auth::id())->simplePaginate(5);
        return view('users.dashboard', compact('posts'));
    }
}
