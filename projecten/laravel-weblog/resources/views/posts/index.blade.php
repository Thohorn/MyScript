@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<h1 class="center">Alle Posts</h1>

<div class="center">
    <table>
        <thead>
            <tr>
                <th>Titel</th>
                <th>Plaatsing</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></td>
                <td>{{ $post->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="center">
    {{ $posts->links() }}
</div>
@endsection