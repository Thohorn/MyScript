@extends('layouts.app')

@section('title', 'Log in')

@section('content')
<h1 class="center">Log in.</h1>
<div class="center">
<form method="POST" action="{{ route('login') }}">
    @csrf
    <label for="username">Gebruikersnaam:</label>
    <input id="username" name="username" :value="old('username')" required>
    <br>
    <label for="password">Wachtwoord</label>
    <input type="password" id="password" name="password" required>
    <x-form-error name="incorrect" />
    <br>
    <button type="submit">Login</button>
</form>
</div>
@endsection