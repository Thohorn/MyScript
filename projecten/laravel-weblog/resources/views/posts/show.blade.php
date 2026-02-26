@extends('layouts.app')

@section('title', 'post')

@section('content')
<h1 class="center">{{ $post->title }}</h1>
<p class="center">{{ $post->body }}</p>
<div class="center">
    <image src="{{ $post->image }}"></image>
</div>
@endsection