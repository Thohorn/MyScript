<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::with('categories', 'comments')
            ->when($request->category, fn($query, $category) => $query->whereRelation('categories', 'name', $category))
            ->orderBy('created_at', 'DESC')
            ->simplePaginate(5);

        $categories = Category::orderBy('name', 'ASC')->get();

        return view('posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepostRequest $request)
    {
        //  TODO :: korter
        //  Done
        $validated = $request->validated();

        $category_ids = array_pop($validated);
        $validated['user_id'] = Auth::id();

        $post = Post::create($validated);

        // TODO :: category_id ook valideren ->sync()
        // Done
        $post->categories()->sync($category_ids);

        return redirect()->route('posts.show', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // TODO :: post met de comment terug geven?
        // Done
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $category_ids = array_pop($validated);

        $post->update($validated);

        // TODO :: ->sync()
        // Done
        $post->categories()->sync($category_ids);

        return redirect(route('posts.show', $post));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect(route('users.index'));
    }
}
