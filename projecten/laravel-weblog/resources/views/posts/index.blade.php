@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<h1 class="center">Alle Posts</h1>
<x-category-filter :categories="$categories" />
<x-posts-overview :posts="$posts" />
@endsection