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
        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @elseif($message = Session::get('failed'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif
    </div>
</div>
@endsection
