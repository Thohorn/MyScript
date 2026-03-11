@extends('layouts.app')

@section('title', 'Posts')

@section('content')
<h1 class="center">Alle Posts</h1>

<x-posts-overview :posts="$posts"/>
@endsection