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

    public function store(StoreTicketRequest $request): ResourceCollection {
        $ticket = $request->validated();
        Ticket::create($ticket);
        
        return TicketResource::collection(Ticket::orderBy('created_at', 'DESC')->get());
    }

    public function update(StoreTicketRequest $request, Ticket $ticket): Ticket {
        $user = Auth::user();
        $validated = $request->validated();
        if ($user->role === "admin" || $user->id === $validated["user_id"]){
            $ticket->update($validated);
            return $ticket;
        }
        else {
            throw new HttpResponseException(response()->json([
                'message' => 'Je mag de ticket niet aanpassen.'
            ], 422));
        }
        
    }
}
