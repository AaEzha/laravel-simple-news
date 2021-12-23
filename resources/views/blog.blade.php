@extends('layouts.blog')

@section('main-content')

    @foreach ($articles as $article)
    <div class="pb-5">
        <p class="h1 font-weight-bold text-primary"><a href="{{ route('read', $article->slug) }}">{{ $article->title }}</a></p>
        <p>Ditulis oleh <span class="text-primary">{{ $article->user->full_name }}</span>, {{ (is_null($article->updated_at)) ? $article->created_at->format('d F Y, H:i') : $article->updated_at->format('d F Y, H:i')}}</p>
        <hr>
        <div class="pb-3">
            <img src="{{ asset('storage/'.$article->thumbnail) }}" alt="{{ $article->title }}" class="img-fluid">
        </div>
        <div class="pb-3">
            {!! Str::limit(strip_tags($article->content), 50) !!}
        </div>
        <div class="font-weight-bold pb-3"><a href="{{ route('read', $article->slug) }}"><em>Baca selengkapnya</em></a></div>
        <p>Category <span class="text-info">{{ $article->category->name }}</span></p>
    </div>
    @endforeach

    {{ $articles->links() }}

@endsection
