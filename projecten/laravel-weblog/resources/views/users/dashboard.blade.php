@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="center">Hallo {{ Auth::user()->username}}</h1>
    <div class="center">Jouw posts: <br></div>
    <x-posts-overview :$posts :personal="True"/>
@endsection