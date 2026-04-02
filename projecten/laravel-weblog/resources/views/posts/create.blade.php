@extends('layouts.app')

@section('title', 'Maak Post')

@section('content')
<h1 class="center">Maak Post</h1>
<div class="center">
    <form method="POST" action="/posts">
        @csrf
        <div class="form-element">
            <label for="title">Titel:</label>
            <input type="text" id="title" name="title" required>
            <x-form-error name="title" />
        </div>

        <div class="form-element">
            <label for="body">Inhoud:</label>
            <textarea id="body" name="body" required></textarea>
            <x-form-error name="body" />
        </div>

        <div class="form-element">
            <label for="image">Afbeelding:</label>
            <input type="text" id="image" name="image">
        </div>

        <div class="form-element">
            <label for="category_id">Categorie/categoriën</label>
            <select name="category_id[]" id="category" multiple required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-element">
            <label for="premium">Premium:</label>
            <input type="checkbox" id="premium" name="premium" value="0" checked hidden>
            <input type="checkbox" id="premium" name="premium" value="1">
        </div>

        <div class="form-element">
            <label for="published">Gepubliceerd</label>
            <input type="checkbox" id="published" name="published" value="0" checked hidden>
            <input type="checkbox" id="published" name="published" value="1">
        </div>

        <button type="submit">Opslaan</button>
    </form>
</div>
@endsection