@extends('layout')
@section('content')
<div class="content-container">
    <form action="{{ route('posts.update') }}" method="POST">
        @csrf
        <div class="form-ttl">
            <h3>Edit Post</h3>
        </div>
        <div>
            <input type="hidden" value="{{ $post->created_by }}" name="created_by" id="created_by">
            <input type="hidden" value="{{ $updated_by }}" name="updated_by" id="updated_by">
            <input type="hidden" value="{{ $post->id }}" name="id" id="id">
        </div>
        <div>
            <label for="title">Title</label><br>
            <input id="title" name="title" value="{{ $errors->any()?old('post'):$post->title }}">
        </div>
        @if($errors->has('title'))
        <div>
            <p>{{ $errors->first('title') }}</p>
        </div>
        @endif
        <div>
            <label for="description">Description</label><br>
            <textarea id="description" name="description">{{ $errors->any()?old('description'):$post->description }}</textarea>
        </div>
        @if($errors->has('description'))
        <div>
            <p>
                {{ $errors->first('description') }}
            </p>
        </div>
        @endif
        <div>
            <label for="public_flag">Make your post public?</label>
            <input type="checkbox" @if($errors->any()) @if(old('public_flag')) checked @endif @else @if($post->public_flag) checked @endif @endif id="public_flag" name="public_flag">
        </div>

        <div><button type="submit">Submit</button></div>
    </form>
</div>

@endsection
