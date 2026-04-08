@props([
'posts',
'personal' => False,
])

<div class="center">
    <table>
        <thead>
            <tr>
                <th>Titel</th>
                <th>Datum</th>
                <th>Premium</th>
                <?php
                if ($personal == True) { ?>
                    <th>Bewerken</th>
                    <th>Verwijderen</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></td>
                <td>{{ $post->created_at }}</td>
                <td><?= $post->premium ? "Ja" : "Nee" ?></th>
                <?php
                if ($personal == True) { ?>
                    <td><a href="{{ route('posts.edit', $post) }}">Bewerken</a></td>
                    <td>
                        <form method='POST' action="{{ route('posts.destroy', $post) }}">
                            @csrf
                            @method('DELETE')
                            <button type='submit' onclick="return confirm('Weet je zeker dat je {{ $post->title }} wilt verwijderen?')">Verwijderen</button>
                        </form>
                    </td>
                <?php } ?>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="center">
    {{ $posts->links() }}
</div>