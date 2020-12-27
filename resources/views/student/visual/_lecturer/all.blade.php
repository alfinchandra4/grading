@extends('student.layouts.app')

@section('pagetitle', 'Student Dashboard')

@section('user_profile', 'Alfin Chandra | 15015012005')

@section('leftbtn')
    <a href="#" class="btn btn-outline-success btn-sm">Report</a>
    <a href="#" class="btn btn-success btn-sm">Isi kuesioner</a>
@endsection

@section('content')
    <div>
        <ul class="bundle_chart mt-3">
            <!-- 1 -->
            <li><a href="{{ route('student.visual.all', [$role, 1]) }}">Keseluruhan</a></li>
            <!-- 2 -->
            <li>Statistik</li>
            <!-- 3 -->
            <li>Perbandingan</li>
            <!-- 4 -->
            <li>Detail</li>
        </ul>
    </div>
    <div class="each_chart mt-4">
        <div class="each_chart_visual container">
            <h1>Lecturer</h1>
        </div>
    </div>
@endsection
