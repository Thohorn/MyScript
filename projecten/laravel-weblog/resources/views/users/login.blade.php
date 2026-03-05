@extends('layouts.app')

@section('title', 'Log in')

@section('content')
<h1 class="center">Log in.</h1>
<form method="POST" action="{{ route('users.login') }}">
    <button type="submit">Login</button>
</form>
@endsection