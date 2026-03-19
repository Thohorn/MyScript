@extends('layouts.app')

@section('title', 'post')

@section('content')
<div class="mw-70 marginlr-auto">

    <div id="post">
        <h1 class="center">{{ $post->title }}</h1>
        <p class="center">{{ $post->body }}</p>
        <div class="center">
            <image src="{{ $post->image }}"></image>
        </div>
    </div>

    <div id="comments">
        @foreach($comments as $comment)
        <div class="comment">
            <div class="comment-header">
                {{ $comment->user->username}}
            </div>
            <div class="comment-body">
                {{ $comment->body}}
            </div>
            <div class="comment-footer">
                {{ $comment->created_at}}
            </div>
        </div>
        @endforeach

        {{ $comments->links() }}

        <div id="add-comment" class="center">
            <form method="POST" action="/comments">
                @csrf
                <label for="body">Laat commentaar achter:</label>
                <br>
                <textarea id="body" name="body" required></textarea>
                <x-form-error name="body" />
                <input id="post_id" value="{{ $post->id }}" name="post_id" hidden>
                <br>
                <button type="submit">Plaats commentaar</button>
            </form>
        </div>

    </div>

</div>
@endsection