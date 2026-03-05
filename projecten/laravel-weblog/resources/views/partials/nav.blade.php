<nav class="center">
    <div class="beginning">
        <x-nav-button href="{{ route('posts.index') }}" :active="request()->is('posts')">Post Lijst</x-nav-button>
        <x-nav-button href="{{ route('posts.create') }}" :active="request()->is('posts/create')">Maak Post</x-nav-button>
    </div>
    <div class="end">
        @guest
        <x-nav-button href="{{ route('users.register.show') }}" :active="request()->is('users/register')">Registreer</x-nav-button>
        <br>
        <x-nav-button href="{{ route('users.login') }}" :active="request()->is('users/login')">Log In</x-nav-button>
        @endguest
    </div>
</nav>