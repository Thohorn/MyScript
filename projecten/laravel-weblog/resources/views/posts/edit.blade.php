@extends('layouts.app')

@section('title', 'Bewerk Post')

@section('content')
<h1 class="center">Bewerk Post</h1>
<div class="center">
    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PATCH')
        <label for="title">Titel:</label>
        <input 
            type="text"
            id="title"
            name="title"
            value="{{ $post->title }}"
            required>
        <x-form-error name="title" />
        <br>
        <label for="body">Inhoud:</label>
        <textarea 
            id="body"
            name="body"
            required>{{ $post->body }}</textarea>
        <x-form-error name="body" />
        <br>
        <label for="image">Afbeelding:</label>
        <input 
            type="text"
            id="image" 
            name="image"
            value="<?= $post->image ? $post->image: ''?>">
        <br>
        <select name="category_id" id="category" multiple required>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" <?php $post->categories->search($category) != false ? "selected" : "" ?>>{{ $category->name }}</option>
            @endforeach
        </select>
        <br>
        <label for="premium">Premium:</label>
        <input type="checkbox" id="premium" name="premium" value="0" checked hidden>
        <input type="checkbox" id="premium" name="premium" value="1" <?= $post->premium ? "checked" : ""?>>
        <br>
        <label for="published">Gepubliceerd</label>
        <input type="checkbox" id="published" name="published" value="0" checked hidden>
        <input type="checkbox" id="published" name="published" value="1" <?= $post->published ? "checked" : ""?>>
        <br>
        <button type="submit">Bewerken</button>
    </form>
</div>
@endsection