@extends('layouts.app')

@section('search')
{{Form::open(['url' => route('articles.index'), 'method' => 'GET'])}}
    {{Form::text('q', $querySearch)}}
    {{Form::submit('найти')}}
{{Form::close()}}
@endsection

@section('content')
    <h1>Список статей</h1>
    @foreach ($articles as $article)
        <h2>
            <a href="{{ route('articles.show', ['id' => $article->id]) }}">
                {{$article->name}}
            <a>
        </h2>
        {{-- Str::limit – функция-хелпер, которая обрезает текст до указанной длины --}}
        {{-- Используется для очень длинных текстов, которые нужно сократить --}}
        <div>{{Str::limit($article->body, 200)}}</div>
    @endforeach
    <div>{{ $articles->links() }}</div>
@endsection