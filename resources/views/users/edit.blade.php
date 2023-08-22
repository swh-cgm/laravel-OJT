@extends('layout')
@section('content')
<div class="content-container">
    <form enctype="multipart/form-data" action="{{ route('users.update') }}" method="POST">
        @csrf
        <div class="form-ttl">
            <h3>Edit User</h3>
        </div>
        <div>
            <input name="id" name="id" id="id" type="hidden" @if ($errors->any()) value="{{old('id')}}" @else value="{{ $user->id }}" @endif>
        </div>

        <div>
            <label for="img">Profile Picture</label><br>
            <input type="file" name="img" id="img" accept="image/*">
        </div>
        @if ($errors->has('img'))
        <div>
            <p>{{ $errors->first('img') }}</p>
        </div>
        @endif
        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" placeholder="Email" @if ($errors->any()) value="{{old('email')}}" @else value="{{ $user->email }}" @endif>
        </div>
        @if ($errors->has('email'))
        <div>
            <p>{{ $errors->first('email') }}</p>
        </div>
        @endif
        <div>
            <label for="name">Name</label><br>
            <input type="text" name="name" id="name" placeholder="Name" @if ($errors->any()) value="{{old('name')}}" @else value="{{ $user->name }}" @endif>
        </div>
        @if ($errors->has('name'))
        <div>
            <p>{{ $errors->first('name') }}</p>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div>
            <p>{{ $message }}</p>
        </div>
        @endif
        <div>
            <label for="user-role">Admin</label>
            <input type="radio" name="role" id="admin-role" value="{{config('constants.user_role.admin_no')}}" {{ $user->role == config('constants.user_role.admin_no')? 'checked': '' }}>

            <label for="user-role">Member</label>
            <input type="radio" name="role" id="user-role" value="{{config('constants.user_role.member_no')}}" {{ $user->role == config('constants.user_role.member_no')? 'checked': '' }}>
        </div>
        @if ($errors->has('role'))
        <div>
            <p>{{ $errors->first('role') }}</p>
        </div>
        @endif
        <div class="form-submit-btn">
            <button type="submit">Submit</button>
        </div>
    </form>

    <div>
        <a href="{{ route('changePasswordScreen') }}">Change Password</a>
    </div>
    <div>
        <a href="{{ route('users.delete', $user->id) }}" class="text-danger">Delete</a>
    </div>
</div>
@endsection
