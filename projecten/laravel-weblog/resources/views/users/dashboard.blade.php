@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1 class="center">Hallo gebruiker.</h1>
<form method="POST" action="{{ route('users.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
@endsection