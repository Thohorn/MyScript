<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;


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

    public function login()
    {
        return view('users.login');
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect('/');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->where('user_id', Auth::id())->simplePaginate(5);

        return view('users.dashboard', compact('posts'));
    }


    public function create()
    {
        return view('users.create');
    }

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

        return redirect()->route('users.index');
    }
}
