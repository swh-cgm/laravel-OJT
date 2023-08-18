@extends('layout')
@section('content')

<form enctype="multipart/form-data" action="{{ route('users.store') }}" method="POST" class="container">
    @csrf
    <div class="form-content">
        <div class="form-title">
            <p>Add New User</p>
        </div>
        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>
        @if ($errors->has('email'))
        <div>
            <p>{{ $errors->first('email') }}</p>
        </div>
        @endif
        <div>
            <label for="name">Name</label><br>
            <input type="text" name="name" id="name" placeholder="Name">
        </div>
        @if ($errors->has('name'))
        <div>
            <p>{{ $errors->first('name') }}</p>
        </div>
        @endif
        <div>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        @if ($errors->has('password'))
        <div>
            <p>{{ $errors->first('password') }}</p>
        </div>
        @endif
        <div>
            <label for="password_confirmation">Confirm Password</label><br>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
        </div>
        @if ($errors->has('password_confirmation'))
        <div>
            <p>{{ $errors->first('password_confirmation') }}</p>
        </div>
        @endif
        <div>
            <label for="img">Profile Picture</label><br>
            <input type="file" name="img" id="img" accept="image/*">
        </div>
        @if ($errors->has('img'))
        <div>
            <p>{{ $errors->first('img') }}</p>
        </div>
        @endif
        @if ($message = Session::get('error'))
        <div>
            <p>{{ $message }}</p>
        </div>
        @endif
        <div>
            <label for="user-role">Admin</label>
            <input type="radio" name="role" id="admin-role" value="1">

            <label for="user-role">User</label>
            <input type="radio" name="role" id="user-role" value="2">
        </div>
        @if ($errors->has('role'))
        <div>
            <p>{{ $errors->first('role') }}</p>
        </div>
        @endif
        <div>
            <button type="submit">Submit</button>
        </div>
    </div>

</form>



@endsection