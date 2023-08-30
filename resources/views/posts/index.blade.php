@extends('layout')
@section('content')
<div class="content-container">

    @if(Session::has('error'))
      <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @elseif(Session::has('success'))
      <div class="alet alert-success">{{ Session::get('success') }}</div>
    @endif
    @if(count($errors)>0)
      @foreach ($errors->all() as $error)
        <p class="alert alert-warning">{{ $error }}</p>
      @endforeach
    @endif

    @foreach($posts as $post)
    <div class="post-container">
        <h6>Title</h6>
        <p>{{$post->title}}</p><br>
        <h6>Description</h6>
        <p>{{ $post->description }}</p>
        <div>
            @if(count($post->comments))
              <br>
              <div>Comments : </div>
              @foreach($post->comments as $comment)
                <div>{{$comment->comment}}</div>
              @endforeach
            @endif
        </div>
        <a href="{{ route('posts.show', $post->id) }}" rel="show post">More</a>
    </div>
    @endforeach

</div>
@endsection
