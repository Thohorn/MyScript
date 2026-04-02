@extends('layouts.app')

@section('title', 'Log in')

@section('content')
<h1 class="center">Log in.</h1>
<div class="center">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-element">
            <label for="username">Gebruikersnaam:</label>
            <input id="username" name="username" :value="old('username')" required>
        </div>

        <div class="form-element">
            <label for="password">Wachtwoord</label>
            <input type="password" id="password" name="password" required>
            <x-form-error name="incorrect" />
        </div>

        <button type="submit">Login</button>
    </form>
</div>
@endsection