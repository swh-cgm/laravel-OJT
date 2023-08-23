@extends('layout')

@section('content')
<div class="content-container">
    @if(count($errors)>0)
    @foreach ($errors->all() as $error)
    <p class="alert alert-warning">{{ $error }}</p>
    @endforeach
    @endif
    <div>
        <a href="{{ route('posts.edit', [$post->id]) }}" rel="edit post">Edit</a><br>
        <a href="{{ route('posts.delete', [$post->id]) }}" rel="delete post">Delete</a>
    </div>
    <br>
    <div>
        <h5>User Name</h5>
        <h6>{{ $originalPoster->name }}</h6>
    </div><br>
    <div>
        <h5>Title</h5>
        <h6>{{ $post->title }}</h6>
    </div><br>
    <div>
        <h6>Description</h6>
        <p>{{ $post->description }}</p>
    </div>
</div>
@endsection
