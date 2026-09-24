<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index(Request $request):ResourceCollection {
        return NoteResource::collection((Note::where('ticket_id', $request->route()->ticket)->OrderBy('created_at', 'DESC')->get()));
    }

    public function store(StoreNoteRequest $request){
        Note::create($request->validated());

        // $ticket = Ticket::where('id', $request['ticket_id'])->first();

        return NoteResource::collection((Note::where('ticket_id', $request['ticket_id'])->get()));
    }

    public function update(StoreNoteRequest $request, Note $note): Note {
        $user = Auth::user();
        if ($user->role === 'admin'){
            $note->update($request->validated());
            return $note;
        }
        else {
            throw new HttpResponseException(response()->json([
                'message' => 'Je mag de ticket niet aanpassen.'
            ], 422));
        }
    }

    public function destroy(Note $note) {
        $note->delete();       
    }
}
