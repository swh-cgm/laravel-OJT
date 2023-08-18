@extends('layout')
@section('content')
<h3>User Detail</h3>
@if($user->img)

<img src="{{ asset('/storage/UserImages/' . $user->img) }}" alt="User Image" width="100" height="100">

@endif
<div>User ID: {{ $user->id }}</div>
<div>Name: {{ $user->name }}</div>
<div>email: {{ $user->email }}</div>
<div>Role: {{ ($user->role == 1) ? 'Admin' : 'Member' }}</div>

@endsection
