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
    <div>Role: {{ ($user->role == config('constants.user_role.admin_no')) ? config('constants.user_role.admin_role') : config('constants.user_role.member_role') }}</div>
</div>

@endsection
