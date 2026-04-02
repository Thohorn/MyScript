@extends('layouts.app')

@section('title', 'Bewerk Post')

@section('content')
<h1 class="center">Bewerk Post</h1>
<div class="center">
    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('PATCH')
        <div class="form-element">
            <label for="title">Titel:</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ $post->title }}"
                required>
            <x-form-error name="title" />
        </div>

        <div class="form-element">
            <label for="body">Inhoud:</label>
            <textarea
                id="body"
                name="body"
                required>{{ $post->body }}</textarea>
            <x-form-error name="body" />
        </div>

        <div class="form-element">
            <label for="image">Afbeelding:</label>
            <input
                type="text"
                id="image"
                name="image"
                value="<?= $post->image ? $post->image : '' ?>">
        </div>

        <div class="form-element">
            <label for="category_id">Categorie/categoriën</label>
            <select name="category_id[]" id="category" multiple required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    <?php
                    $notSet = true;
                    foreach ($post->categories->toArray() as $postCategory) {
                        if ($postCategory['id'] === $category['id']) {
                            echo 'selected';
                            $notSet = false;
                        }
                    }
                    if ($notSet) {
                        echo '';
                    }
                    ?>>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-element">
            <label for="premium">Premium:</label>
            <input type="checkbox" id="premium" name="premium" value="0" checked hidden>
            <input type="checkbox" id="premium" name="premium" value="1" <?= $post->premium ? "checked" : "" ?>>
        </div>

        <div class="form-element">
            <label for="published">Gepubliceerd</label>
            <input type="checkbox" id="published" name="published" value="0" checked hidden>
            <input type="checkbox" id="published" name="published" value="1" <?= $post->published ? "checked" : "" ?>>
        </div>

        <button type="submit">Bewerken</button>
    </form>
</div>
@endsection