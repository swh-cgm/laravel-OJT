@extends('layout')
@section('content')
<div class="content-container">
    @if(count($errors)>0)
        @foreach ($errors->all() as $error)
          <p class="alert alert-warning">{{ $error }}</p>
        @endforeach
     @endif
    <h3 class="user-detail-ttl">User Detail</h3>
    @if($user->img)
      <img src="{{ asset('/storage/UserImages/' . $user->img) }}" alt="User Image" width="150" height="150">
    @endif

    <div>User ID: {{ $user->id }}</div>
    <div>Name: {{ $user->name }}</div>
    <div>email: {{ $user->email }}</div>
    <div>Role: {{ ($user->isAdmin()) ? config('constants.user_role.admin_role') : config('constants.user_role.member_role') }}</div>

      <div>
        @if(count($user->posts)!=0)
            @foreach($user->posts as $post)
                <div class="user-posts">
                    Post: <a href="{{ route('posts.show', $post->id) }}" alt="post">{{$post->title}}</a><br>
                    @if(count($post->comments)!=0)
                        Comments :
                        @foreach($post->comments as $comment)
                            <div class="user-comments">{{$comment->comment}}</div>
                        @endforeach
                    @endif
                </div>
            @endforeach
        @endif
      </div>
</div>
@endsection
