<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResponseRequest;
use App\Http\Resources\ResponseResource;
use App\Models\Response;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\ResponseAdded;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function index(Request $request):ResourceCollection {
        return ResponseResource::collection((Response::where('ticket_id', $request->route()->ticket)->get()));
    }

    public function store(StoreResponseRequest $request){
        Response::create($request->validated());

        $user = User::where('id', $request['user_id'])->first();
        $user->notify(new ResponseAdded(Ticket::where('id', $request['ticket_id'])->first()));

        return ResponseResource::collection((Response::where('ticket_id', $request['ticket_id'])->get()));
    }
}
