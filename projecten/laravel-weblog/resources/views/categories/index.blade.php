@extends('layouts.app')

@section('title', 'Categoriën')

@section('content')
<h1 class="center">Alle Categoriën</h1>
@auth
    <div class="center">
        <a href="{{ route('categories.create') }}">Nieuwe categorie toevoegen</a>
    </div>
@endauth
<x-categories-overview :categories="$categories"/>
@endsection