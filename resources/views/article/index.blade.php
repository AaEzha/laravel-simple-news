@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <a href="{{ route('article.create') }}" class="btn btn-primary mb-3">New Article</a>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Article</th>
                <th>Slug</th>
                <th>Category</th>
                <th>Writer</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($articles as $article)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->slug }}</td>
                    <td>{{ $article->category->name }}</td>
                    <td>{{ $article->user->full_name }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('article.edit', $article->id) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <form action="{{ route('article.destroy', $article->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center font-weight-bold p-5 h4">No article yet. Mind to <a href="{{ route('article.create') }}">create one</a>?</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $articles->links() }}

    <!-- End of Main Content -->
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush
