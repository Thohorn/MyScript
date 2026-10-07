<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

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

    public function update(StoreUserRequest $request, User $user): User {
        $user->update($request->validated());
        return $user;
    }

    public function destroy(User $user) {
        $userTickets = $user->tickets;
        foreach($userTickets as $ticket){
            if($ticket['status'] !== 'Opgelost'){
                throw new HttpResponseException(response()->json([
                    'message' => 'Deze gebruiker kan niet worden verwijderd omdat nog niet alle tickets zijn afgerond.'
                ], 422));
            }
        }

        $assignedTickets = Ticket::where('assigned_to' , $user->id)->get();
        if($user->role === 'admin' && !$assignedTickets->isEmpty()){
                throw new HttpResponseException(response()->json([
                    'message' => 'Deze gebruiker kan niet worden verwijderd omdat hij is toegewezen aan een of meer tickets.'
                ], 422));
            }

        Ticket::where('user_id', $user->id)->delete();
        $user->delete();
    }
}
