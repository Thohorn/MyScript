<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResponseResource;
use App\Models\Response;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ResponseController extends Controller
{
    public function index(Ticket $ticket):ResourceCollection {
        return ResponseResource::collection((Response::where('ticket_id', $ticket->id)->get()));
    }
}
