@props(['categories'])
<h2 class="center">Categoriën</h2>
<div class="center">
    <x-nav-button href="/posts" :active="request()->has('category') ? false : true">Alle</x-nav-button>
    @foreach($categories as $category)
    <x-nav-button href="/posts?category={{ $category->name }}" :active="request('category') === $category->name ? true : false">{{ $category->name }}</x-nav-button>
    @endforeach
</div>