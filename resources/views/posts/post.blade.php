@extends('layout')

@section('content')
<div class="content-container">
    @if(count($errors)>0)
        @foreach ($errors->all() as $error)
        <p class="alert alert-warning">{{ $error }}</p>
        @endforeach
    @endif
    @if($post->can_edit)
    <div>
        <a href="{{ route('posts.edit', [$post->id]) }}" rel="edit post">Edit</a><br>
        <a href="{{ route('posts.delete', [$post->id]) }}" rel="delete post">Delete</a>
    </div>
    <br>
    @endif
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
    <div>
        <form @if (Auth::check()) action="{{ route('posts.comment.store', ['post_id'=>$post->id, 'user_id'=>Auth::user()->id]) }}"  method="POST" @endif>
            @csrf
            <div>
              <textarea placeholder="Comment" id="user_comment" name="user_comment" rows="2"></textarea>
              @if($errors->has('user_comment'))
                <div>
                    <p>
                        {{ $errors->first('user_comment') }}
                    </p>
                </div>
              @endif
            </div>
            <div>
                <button type="submit">Comment</button>
            </div>
        </form>
    </div>
</div>
@endsection
