@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="center">Hallo {{ Auth::user()->username}}</h1>
    <div class="center">
        <div><?=Auth::user()->premium ? "Wil je stoppen met premium?" : "Wil je premium?"?></div>
        <div class="margin-left-10">
            <form method="POST" action="{{ route('users.update', Auth::user()) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <button type="submit">Ja</button>
            </form>
        </div>
    </div>
    <div class="center">Jouw posts: <br></div>
    <x-posts-overview :$posts :personal="True"/>
@endsection