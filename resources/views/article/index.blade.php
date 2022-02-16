@extends('layouts.app')

@section('search')
{{-- or ['route' => 'articles.index'] --}}
{{Form::open(['url' => route('articles.index'), 'method' => 'GET'])}}
    {{Form::text('q', $querySearch)}}
    {{Form::submit('найти')}}
{{Form::close()}}
@endsection

@section('content')
    @if (isset($flash))
        <div>{{ $flash }}</div>
    @endif
    <h1>Список статей</h1>
    @foreach ($articles as $article)
        <h2>
            <a href="{{ route('articles.show', $article) }}">
                {{$article->name}}
            <a>
        </h2>
        {{-- Str::limit – функция-хелпер, которая обрезает текст до указанной длины --}}
        {{-- Используется для очень длинных текстов, которые нужно сократить --}}
        <div>{{Str::limit($article->body, 200)}}</div>
        <a href="{{ route('articles.edit', $article) }}">
            Edit
        <a>
        <a href="{{ route('articles.destroy', $article->id) }}" data-confirm="Вы уверены?" data-method="delete" rel="nofollow">Удалить</a>
    @endforeach
    <div>{{ $articles->links() }}</div>
@endsection