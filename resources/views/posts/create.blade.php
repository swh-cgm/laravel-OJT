@extends('layout')
@section('content')
<div class="content-container">
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="form-ttl">
            <h3>Create Post</h3>
        </div>
        <div>
            <input type="hidden" value="{{ $user_id }}" name="user_id" id="user_id">
        </div>
        <div>
            <label for="title">Title</label><br>
            <input name="title" id="title" value="{{ old('title') }}">
        </div>
        @if($errors->has('title'))
        <div>
            <p>{{ $errors->first('title') }}</p>
        </div>
        @endif
        <div>
            <label for="description">Description</label><br>
            <textarea name="description" id="description" placeholder="Description">{{ old('description') }}</textarea>
        </div>
        @if($errors->has('description'))
        <div>
            <p>{{ $errors->first('description') }}</p>
        </div>
        @endif
        <div>
            <label for="public_flag">Make your post public? </label>
            <input type="checkbox" name="public_flag" id="public_flag" @if(old('public_flag')) checked @endif>
        </div>
        @if($errors->has('public_flag'))
        <div>
            <p>{{ $errors->first('public_flag') }}</p>
        </div>
        @endif
        <div>
            <button>Submit</button>
        </div>
    </form>
</div>

@endsection
