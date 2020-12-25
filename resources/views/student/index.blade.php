@extends('layouts.app')

@section('pagetitle', 'Student Dashboard')
@section('content')
    <h2>User Page.. halo {{ Auth::guard('student')->user()->name }}</h2>
    <br>
    <a href="/logout/student">Logout {{ Auth::guard('student')->user()->name }} ??</a>
@endsection
