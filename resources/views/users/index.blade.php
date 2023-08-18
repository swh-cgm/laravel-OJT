@extends('layout')
@section('content')

@if($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@elseif($message = Session::get('failed'))
<div class="alert alert-danger">
    <p>{{ $message }}</p>
</div>
@endif

<table class="user-table">
  <tr>
    <th>User ID</th>
    <th>User Email</th>
    <th>User Name</th>
    <th>User Detail</th>
    <th>Edit User</th>
    <th>Delete User</th>
  </tr>
@foreach ($users as $user)
<tr>
  <td>{{ $user->id }}</td>
  <td>{{ $user->email }}</td>
  <td>{{ $user->name }}</td>
  <td><a href="{{ route('users.detail', $user->id) }}" rel="User Detail">User Details</td>
  <td><a href="{{ route('users.edit', $user->id) }}" rel="Edit User">Edit User</td>
  <td><a class="text-danger" href="{{ route('users.delete', $user->id) }}" rel="Delete User">Delete User</td>
</tr>
@endforeach
</table>

<a>
</a>

@endsection
