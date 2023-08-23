@extends('layout')
@section('content')
<div class="content-container">

    @if(Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @elseif(Session::has('success'))
    <div class="alet alert-success">{{ Session::get('success') }}</div>
    @endif

    @foreach($posts as $post)
    <div class="post-container">
        <p>Post Id: {{$post->id}}</p>
        <h6>Title</h6>
        <p>{{$post->title}}</p>
        <h6>Description</h6>
        <p>{{ $post->description }}</p>
        <a href="{{ route('posts.show', $post->id) }}" alt="more">More &rarr;</a>
    </div>
    @endforeach

</div>
@endsection
