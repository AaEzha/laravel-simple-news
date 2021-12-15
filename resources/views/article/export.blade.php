<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Slug</th>
            <th>Category</th>
            <th>Content</th>
            <th>Writer</th>
            <th>User Views</th>
        </tr>
    </thead>
    <tbody>
        @forelse($articles as $article)
            <tr>
                <td>{{ $article->title }}</td>
                <td>{{ $article->slug }}</td>
                <td>{{ $article->category->name }}</td>
                <td>{!! $article->content !!}</td>
                <td>{{ $article->user->name }}</td>
                <td>{{ $article->user_views }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No article yet</td>
            </tr>
        @endforelse
        <tr>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="6">Printed at {{ $time }}</td>
        </tr>
    </tbody>
</table>
