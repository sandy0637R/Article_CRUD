@extends('layouts.app')

@section('content')

<div class="container">

<h2>Edit Article</h2>

<form
action="{{ route('articles.update',$article->id) }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')

<input
type="text"
name="title"
class="form-control mb-3"
value="{{ $article->title }}">

<textarea
name="content"
class="form-control mb-3">{{ $article->content }}</textarea>

<input
type="number"
name="user_id"
class="form-control mb-3"
value="{{ $article->user_id }}">

<input
type="file"
name="image"
class="form-control mb-3">

@if($article->image)

<img
src="{{ asset('images/'.$article->image) }}"
width="120">

@endif

<button class="btn btn-primary">
Update
</button>

</form>

</div>

@endsection