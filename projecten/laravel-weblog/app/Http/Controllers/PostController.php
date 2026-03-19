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
        $posts = Post::with('categories')
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
        $validated = $request->validated();

        $post = Post::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'user_id' => Auth::id(),
            'image' => $validated['image'],
            'premium' => $validated['premium'],
            'published' => $validated['published'],
        ]);

        if ($request->category_id != null) {
            foreach ($request->category_id as $category) {
                $post->categories()->attach($category);
            }
        }

        return redirect()->route('posts.show', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $comments = Comment::with('user', 'post')
            ->where('post_id', $post->id)
            ->orderBy('created_at', 'DESC')
            ->simplePaginate(5);

        return view('posts.show', compact('post', 'comments'));
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

        $post->update($validated);

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
