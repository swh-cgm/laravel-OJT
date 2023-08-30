@extends('layout')
@section('content')
<div>
    @csrf
    <div>
        <h3>Downloads</h3>
        <div>
            <form  method="GET" action="{{ route('admin.file.csv.posts.download') }}">
                <label>Download Post Table as CSV</label>
                <button type="submit">Download</button>
            </form>
        </div>
    </div>
    <div>
        <h3>Upload</h3>
        <div>
            <form method="POST" action="{{ route('admin.file.csv.posts.upload') }}" enctype="multipart/form-data">
                @csrf
                <label for="posts_csv">Select csv file for posts</label>
                <input name="posts_csv" id="posts_csv" type="file" accept=".csv">
                <button type="submit">Upload</button>
            </form>
        </div>
        @if(Session::has('failures'))
            <p class="text-danger">Failed to insert the following rows.<p>
            @foreach(Session::get('failures') as $failure)
                <p>{{json_encode($failure->values())}}</p>
            @endforeach
        @endif
    </div>
</div>
@endsection
