@props(['categories'])

<div class="center">
    <table>
        <thead>
            <tr>
                <th>Categorie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="center">
    {{ $categories->links() }}
</div>