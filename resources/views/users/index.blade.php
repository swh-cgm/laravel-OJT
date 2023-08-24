@extends('layout')
@section('content')
<div class="content-container">
    @if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @elseif($message = Session::get('failed'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
    @endif
    @if($errors->any())
        @foreach($errors as $error)
            <div class="alert alert-danger">
                <p>{{ $error }}</p>
            </div>
        @endforeach
    @endif
    <div>
        <a href="{{ route('users.create') }}" alt="create user">Create User</a>
    </div>
    <table class="user-table">
        <tr>
            <th>User ID</th>
            <th>User Email</th>
            <th>User Name</th>
            <th>User Detail</th>
            <th>Edit User</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->name }}</td>
            <td><a href="{{ route('users.detail', $user->id) }}" rel="User Detail">User Details</td>
            <td><a href="{{ route('loginScreen') }}" rel="Edit User">Edit User</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
