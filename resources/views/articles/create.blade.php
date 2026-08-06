@extends('layouts.app')

@section('content')

<div class="container">

<h2>Create Article</h2>

<form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">

@csrf

<div class="mb-3">
<label>Title</label>

<input type="text"
name="title"
class="form-control">
</div>

<div class="mb-3">
<label>Content</label>

<textarea
name="content"
class="form-control"></textarea>
</div>

<div class="mb-3">
<label>User ID</label>

<input type="number"
name="user_id"
class="form-control">
</div>

<div class="mb-3">
<label>Image</label>

<input type="file"
name="image"
class="form-control">
</div>

<button class="btn btn-success">
Save
</button>

</form>

</div>

@endsection