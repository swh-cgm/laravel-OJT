@extends('layout')

@section('content')

@foreach ($users as $user)

User ID: {{ $user->id }}<br>

@endforeach