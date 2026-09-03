<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(): ResourceCollection {
        $user = Auth::user();
        if ($user->role === "admin"){
            return TicketResource::collection(Ticket::orderBy('created_at', 'DESC')->get());
        }
        else{
            return TicketResource::collection(Ticket::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get());
        }
    }

    public function store(StoreTicketRequest $request) {
        $ticket = $request->validated();
        Ticket::create($ticket);
        dd(Ticket::all());
    }
}
