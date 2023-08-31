@extends('layout')
@section('content')

<div>
    <div><h3>Admin Functions</h3></div>
    <div class="sub-container">
        <form method="POST" action="{{ route('admin.edit.users.form') }}">
            @csrf
            <div>
                <label for="id">User Id: </label>
                <input id="id" name="id" type="number">
            </div>
            @if($errors->has('id'))
                <p class="text-warning">{{ $errors->first('id') }}</p>
            @endif
            <button type="submit">Submit</button>
        </form>
    </div>

    <div class="sub-container">
        <form method="POST" action="{{ route('admin.edit.posts.form') }}">
            @csrf
            <div>
                <label for="id">Post Id: </label>
                <input id="id" name="id" type="number">
            </div>
            @if($errors->has('id'))
                <p class="text-warning">{{ $errors->first('id') }}</p>
            @endif
            <button type="submit">Submit</button>
        </form>
    </div>
    <div class="sub-container">
        <a rel="file upload download" href="{{ route('admin.file.csv.show') }}">Csv download/ upload</a>
    </div>

</div>

@endsection