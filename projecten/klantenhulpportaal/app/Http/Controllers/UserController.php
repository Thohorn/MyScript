<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        $user = Auth::user();

        if ($user->role === 'admin'){
            return UserResource::collection(User::all());    
        }
        else {
            return UserResource::collection(User::where('id', $user->id)->orWhere('role', 'admin')->get());
        }
        
    }
}
