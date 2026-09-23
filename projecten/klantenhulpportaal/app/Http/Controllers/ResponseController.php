<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResponseRequest;
use App\Http\Resources\ResponseResource;
use App\Models\Response;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\ResponseAdded;
use Illuminate\Http\Exceptions\HttpResponseException;
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

        $ticket = Ticket::where('id', $request['ticket_id'])->first();

        $user = User::where('id', $ticket['user_id'])->first();
        $user->notify(new ResponseAdded(Ticket::where('id', $request['ticket_id'])->first()));

        return ResponseResource::collection((Response::where('ticket_id', $request['ticket_id'])->get()));
    }

    public function update(StoreResponseRequest $request, Response $response): Response {
        $user = Auth::user();
        if ($user->role === 'admin'){
            $response->update($request->validated());
            return $response;
        }
        else {
            throw new HttpResponseException(response()->json([
                'message' => 'Je mag de ticket niet aanpassen.'
            ], 422));
        }
    }
}
