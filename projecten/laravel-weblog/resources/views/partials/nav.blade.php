<nav class="center">
    <div class="beginning">
        <x-nav-button href="{{ route('posts.index') }}" :active="request()->is('posts')">Post Lijst</x-nav-button>
        <x-nav-button href="{{ route('posts.create') }}" :active="request()->is('posts/create')">Maak Post</x-nav-button>
        <x-nav-button href="{{ route('categories.index') }}" :active="request()->is('categories')">Categoriën</x-nav-button>
    </div>
    <div class="end">
        @guest
            <x-nav-button href="{{ route('users.create') }}" :active="request()->is('users/register')">Registreer</x-nav-button>
            <br>
            <x-nav-button href="{{ route('login') }}" :active="request()->is('users/login')">Log In</x-nav-button>
        @endguest
        @auth
            <x-nav-button href="{{ route('users.index') }}" :active="request()->is('users')">Dashboard</x-nav-button>
            <form method="POST" action="{{ route('users.logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth
    </div>
</nav>