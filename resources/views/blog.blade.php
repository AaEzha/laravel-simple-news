@extends('layouts.blog')

@section('main-content')

    @foreach ($articles as $article)
    <div class="pb-5">
        <p class="h1 font-weight-bold text-primary">{{ $article->title }}</p>
        <p>Ditulis oleh <span class="text-primary">{{ $article->user->full_name }}</span>, {{ (is_null($article->updated_at)) ? $article->created_at->format('d F Y, H:i') : $article->updated_at->format('d F Y, H:i')}}</p>
        <hr>
        <div class="pb-3">
            {!! $article->content !!}
        </div>
        <p>Category <span class="text-info">{{ $article->category->name }}</span></p>
    </div>
    @endforeach

    {{ $articles->links() }}

@endsection
