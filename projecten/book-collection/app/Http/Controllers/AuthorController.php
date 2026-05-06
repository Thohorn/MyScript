<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
        return AuthorResource::collection(Author::all());
    }

    public function store(StoreAuthorRequest $request) {
        $author = Author::create($request->validated());

        $authors = Author::all();

        return AuthorResource::collection($authors);
    }

    public function update(StoreAuthorRequest $request, Author $author){
        $author->update($request->validated());

        $authors = Author::all();

        return AuthorResource::collection($authors);
    }

    public function destroy(Author $author) {
        if ($author->books()->first()){
            return response()->json(['error' => 'Auteur heeft boeken geschreven en mag daarom niet verwijderd worden.']);
        }
        $author->delete();

        $authors = Author::all();

        return AuthorResource::collection($authors);
    }
}
