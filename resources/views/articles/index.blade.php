@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Articles</h2>

    <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">
        Add Article
    </a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Slug</th>
            <th>Image</th>
            <th>Action</th>
        </tr>

        @foreach($articles as $article)
        <tr>
            <td>{{ $article->id }}</td>
            <td>{{ $article->title }}</td>
            <td>{{ $article->content }}</td>

            <td>{{ $article->slug }}</td>

            <td>
                @if($article->image)
                    <img src="{{ asset('images/'.$article->image) }}" width="100">
                @endif
            </td>

            <td>
                <a href="{{ route('articles.show',$article->id) }}" class="btn btn-info">
                    View
                </a>

                <a href="{{ route('articles.edit',$article->id) }}" class="btn btn-warning">
                    Edit
                </a>

                <form action="{{ route('articles.destroy',$article->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger">
                        Delete
                    </button>
                </form>

            </td>

        </tr>
        @endforeach

    </table>

    {{ $articles->links() }}

</div>

@endsection