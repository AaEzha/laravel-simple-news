@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('article.update', $article->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                        placeholder="Title" autocomplete="off" value="{{ old('title') ?? $article->title }}" autofocus>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control ckeditor @error('content') is-invalid @enderror" name="content" id="content"
                        rows="3">{{ old('content') ?? $article->content }}</textarea>
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control @error('category') is-invalid @enderror" name="category"
                        id="category">
                        <option value="">Choose a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if ($category->id == $article->category_id) selected @endif >{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" id="thumbnail"
                        placeholder="thumbnail">
                    @error('thumbnail')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @if (!empty($article->thumbnail))
                        <p class="pt-3"><a href="{{ asset('storage/'.$article->thumbnail) }}" target="_blank"><img src="{{ asset('storage/'.$article->thumbnail) }}" alt="{{ $article->title }}" height="300"></a></p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('article.index') }}" class="btn btn-default">Back to list</a>

            </form>
        </div>
    </div>

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

@push('js')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endpush
