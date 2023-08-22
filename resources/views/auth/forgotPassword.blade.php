@extends('layout')
@section('content')
<div class="content-container">
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="form-ttl">
            <h3>Reset Password</h3>
        </div>
        <div>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" placeholder="email">
        </div>
        <div class="form-submit-btn">
            <button type="submit">Submit</button>
        </div>
    </form>

    @if(count($errors)>0)
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
    @endif

    @if(Session::has('status'))
    <p>{{Session::get('status')}}</p>
    @endif
</div>
@endsection
