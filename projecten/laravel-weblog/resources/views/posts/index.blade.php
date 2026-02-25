@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<h1>Posts</h1>

<table>
    <thead>
        <tr>
            <th>Naam</th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection