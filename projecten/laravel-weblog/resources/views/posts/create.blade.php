@extends('layouts.app')

@section('title', 'Maak Post')

@section('content')
<h1 class="center">Maak Post</h1>
<form method="POST" action="/posts">
    @csrf
    <label for="title">Titel:</label>
    <input type="text" id="title" name="title" required>
    <br>
    <label for="body">Inhoud:</label>
    <textarea id="body" name="body"></textarea>
    <br>
    <label for="image">Afbeelding:</label>
    <input type="text" id="image" name="image">
    <br>
    <label for="premium">Premium:</label>
    <input type="checkbox" id="premium" name="premium" value="0" checked hidden>
    <input type="checkbox" id="premium" name="premium" value="1">
    <br>
    <label for="published">Gepubliceerd</label>
    <input type="checkbox" id="published" name="published" value="0" checked hidden>
    <input type="checkbox" id="published" name="published" value="1">
    <br>
    <button type="submit">Opslaan</button>
</form>
@endsection