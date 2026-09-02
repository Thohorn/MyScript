<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index() {
        $user = Auth::user();
        // Hij geeft geen array terug vandaar =>values()
        if ($user->role === "admin"){
            return TicketResource::collection(Ticket::all())->values();
        }
        else{
            return TicketResource::collection(Ticket::where('user_id', $user->id)->get())->values();
        }
    }
}
