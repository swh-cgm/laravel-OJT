@extends('layout')
@section('content')
<div class="content-container">
    <form enctype="multipart/form-data" action="{{ route('admin.edit.users.update') }}" method="POST">
        @csrf
        @if(count($errors)>0)
            @foreach ($errors->all() as $error)
                <p class="alert alert-warning">{{ $error }}</p>
            @endforeach
        @endif
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
            <input type="radio" name="role" id="admin-role" value="{{config('constants.user_role.admin_no')}}" {{ $user->isAdmin()? 'checked': '' }}>

            <label for="user-role">Member</label>
            <input type="radio" name="role" id="user-role" value="{{config('constants.user_role.member_no')}}" {{ !$user->isAdmin()? 'checked': '' }}>
        </div>
        @if ($errors->has('role'))
        <div>
            <p>{{ $errors->first('role') }}</p>
        </div>
        @endif
        <div>
            <label for="new_password">New Password</label><br>
            <input type="password" id="new_password" name="new_password" placeholder="New Password">
        </div>
        @if ($errors->has('new_password'))
        <div>
            <p>{{ $errors->first('new_password') }}</p>
        </div>
        @endif
        <div>
            <label for="old_password">Confirm New Password</label><br>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm New Password">
        </div>
        @if ($errors->has('new_password_confirmation'))
        <div>
            <p>{{ $errors->first('new_password_confirmation') }}</p>
        </div>
        @endif

        <div class="form-submit-btn">
            <button type="submit">Submit</button>
        </div>
    </form>

    <div>
        <a href="{{ route('users.delete', $user->id) }}" class="text-danger">Delete</a>
    </div>
</div>
@endsection
