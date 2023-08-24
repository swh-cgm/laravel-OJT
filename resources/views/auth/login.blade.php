@extends('layout')
@section('content')
<div class="content-container">
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <div class="form-ttl">
                <h3>Login</h3>
            </div>
            <div>
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
            </div>
            <div>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-submit-btn">
                <button type="submit">Login</button>
                <a href="{{ route('password.request') }}">Forgot Password</a>
            </div>
        </div>
    </form>

    @if(count($errors)>0)
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
    @endif
</div>
@endsection
