@extends('layout')
@section('content')
<div class="content-container">
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <div class="form-ttl">
            <h3>Update Password</h3>
        </div>
        <div>
            <input type="hidden" value="{{$token}}" name="token" id="token">
        </div>
        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>
        <div>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>

        <div>
            <label for="password_confirmation">Password Confirmation</label><br>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation">
        </div>
        <div class="form-submit-btn">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>
@endsection
