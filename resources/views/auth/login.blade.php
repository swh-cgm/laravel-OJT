@extends('layout')
@section('content')

<form>
    <div>
        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email">
        </div>
        
        <div>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password">
        </div>
    </div>

</form>

@endsection