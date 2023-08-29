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
    @endif
    <div>
        <p class="post-user">Post by: {{ $originalPoster->name }}</p>
    </div>
    <div>
        <p class="post-title">Title: {{ $post->title }}</p>
    </div>
    <div>
        <p class="post-desc">Description: {{ $post->description }}</p>
    </div>
    <div>
        <div class="comment_container" id="comment_container">
            <h4>Comments</h4>

            @if(count($comments) != 0)
            @foreach($comments as $comment)
            <div class="comment-wrap">
                <div>
                    <span>
                        <a class="comment-user" href="{{route('users.detail', $comment->user->id)}}">{{ $comment->user->name }}</a>
                    </span>
                    @if($comment->can_edit)
                    <span>
                        <a class="edit-comment comment-inner" rel="edit" id="{{'edit-comment-id_'.$comment->id}}">Edit</a>
                        <a class="text-danger" href="{{route('comments.delete', [$comment->id])}}" rel="delete">Delete</a>
                    </span>
                    @endif
                </div>
                <div class="comment-text comment-inner" id="{{'text-comment-id_'.$comment->id}}">{{ $comment->comment }}</div>
            </div>
            @endforeach
            @endif

        </div>
        <div>

            @if(Auth::check())

            <form id="CommentForm" method="POST" action="#">
                @csrf
                <div>
                    <input type="hidden" @if(Auth::check()) value="{{ Auth::user()->id }}" @endif id="user_id">
                    <input type="hidden" value="{{ $post->id }}" id="post_id">
                </div>
                <div>
                    <textarea placeholder="Comment" id="user_comment" name="user_comment" rows="2"></textarea>
                    <p id="commentErrorMessage" class="text-warning"></p>
                </div>
                <div>
                    <button type="submit">Comment</button>
                </div>
            </form>
            @else
            <div>Please Login to comment.</div>
            @endif
        </div>
    </div>
</div>
@endsection
