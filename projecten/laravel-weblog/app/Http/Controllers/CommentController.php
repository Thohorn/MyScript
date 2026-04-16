<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StorecommentRequest;
use App\Http\Requests\UpdatecommentRequest;
use App\Models\Post;
use App\Models\User;
use App\Notifications\CommentPosted;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecommentRequest $request)
    {
        $validated = $request->validated();

        Comment::create([
            'body' => $validated['body'],
            'user_id' => Auth::id(),
            'post_id' => $validated['post_id'],
        ]);


        $post = Post::find($validated['post_id']);
        $poster = User::find($post['user_id']);

        $poster->notify(new CommentPosted($post));

        return redirect()->route('posts.show', [$post]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
