<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        return BookResource::collection(Book::all());
    }

    public function store(StoreBookRequest $request) {
        Book::create($request->validated());

        $books = Book::all();
        
        return BookResource::collection($books);
    }

    public function update(StoreBookRequest $request, Book $book) {
        $book->update($request->validated());

        $books = Book::all();
        return BookResource::collection($books);
    }

    public function destroy(Book $book) {
        foreach ($book->reviews as $review) {
            $review->delete();
        }
        
        $book->delete();
        return response()->json(['message' => 'Boek succesvol verwijderd']);
    }
}
