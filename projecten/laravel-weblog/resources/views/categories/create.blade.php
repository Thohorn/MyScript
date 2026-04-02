@extends('layouts.app')

@section('title', 'Maak Categorie')

@section('content')
<h1 class="center">Maak Categorie</h1>
<div class="center">
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div class="form-element">
            <label for="name">Categorie:</label>
            <input type="text" id="name" name="name" required>
            <x-form-error name="name" />
        </div>

        <button type="submit">Opslaan</button>
    </form>
</div>
@endsection