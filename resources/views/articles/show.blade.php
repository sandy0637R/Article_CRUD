@extends('layouts.app')

@section('content')

<div class="container">

<h2>{{ $article->title }}</h2>

<p>{{ $article->content }}</p>

<p>

<strong>Slug:</strong>

{{ $article->slug }}

</p>

@if($article->image)

<img
src="{{ asset('images/'.$article->image) }}"
width="250">

@endif

<br><br>

<a href="{{ route('articles.index') }}"
class="btn btn-secondary">

Back

</a>

</div>

@endsection