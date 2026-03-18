@extends('layouts.app')

@section('title', 'Registreer')

@section('content')

<h1 class="center">Registreren.</h1>
<div class="center">
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <label for="username">Gebruikersnaam:</label>
        <input id="username" name="username" :value="old('username')" required>
        <x-form-error name="username" />
        <br>
        <label id='email' name='email' :value="old('email')" required>Email-adres</Email-adres></label>
        <input type="email" name="email" id="email">
        <x-form-error name="email" />
        <br>
        <label for="password">Wachtwoord</label>
        <input type="password" id="password" name="password" required>
        <x-form-error name="password" />
        <br>
        <button type="submit">Registreer</button>
    </form>
</div>
@endsection