<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
    
</head>

<body>
    <div class="header container">
        <span>
            <span><a href="{{ route('posts.index') }}" rel="home" class="header-nav-home">Home</a></span>
            @if(Auth::check())
            <span><a href="{{ route('users.index') }}" rel="users" class="header-nav-home">Users</a></span>
            <span><a href="{{ route('posts.create') }}" rel="create" class="header-nav-home">Create</a></span>
            @endif
        </span>
        <span>
            @if(Auth::check())
            @if(Route::currentRouteName()!='users.create' || Auth::user()->role != config('constants.user_role.member_no'))
                <span><a href="{{route('users.edit', Auth::user()->id)}}" rel="user-profile">@if(Auth::user()->isAdmin()) Admin: @endif{{Auth::user()->name}}</a></span> 
                <span><a href="{{ route('logout') }}">Logout</a></span>       

            @endif
            @else
                @if(Route::currentRouteName()!='loginScreen')
                    <span><a href=" {{route('loginScreen')}} ">Login</a></span>
                @endif
                @if(Route::currentRouteName()!='users.create')
                    <span><a href=" {{route('users.create')}} ">Register</a></span>
                @endif
            @endif
        </span>
    </div>
    <div class="container content">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('js/common.js') }}"></script>
</body>

</html>
