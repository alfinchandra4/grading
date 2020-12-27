@extends('student.layouts.app')

@section('pagetitle', 'Student Dashboard')

@section('user_profile', 'Alfin Chandra | 15015012005')

@section('profile')
    <div class="profile_">
        <div class="container">
            <span class="user">
                {{ auth('student')->user()->name }} - {{ auth('student')->user()->nim }}
                <div class="float-end">
                    <a href="#" class="btn btn-outline-success btn-sm">Report</a>
                    <a href="{{ route('student.forms', 1) }}" class="btn btn-success btn-sm">Isi kuesioner</a>
                </div>
            </span>
        </div>
    </div>
@endsection

@section('monitor')
    <div class="monitor">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card card-monitor total_student border-0">
                        <div class="card-body">
                            <span class="card-total">Total Mahasiswa</span>
                            <div class="card-value">3000</div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-monitor total_lecturer border-0">
                        <div class="card-body">
                            <span class="card-total">Total Dosen</span>
                            <div class="card-value">3000</div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-monitor total_alumni border-0">
                        <div class="card-body">
                            <span class="card-total">Total Alumni</span>
                            <div class="card-value">3000</div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-monitor total_responses border-0">
                        <div class="card-body">
                            <span class="card-total">Total Responden</span>
                            <div class="card-value">3000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('actor-list')
    <div class="users_chart">
        <ul class="user_chart">
            <li>
                <a href="{{ route('student.actortype', 1) }}"
                    style="{{ session('actor') == 1 ? 'border-bottom: 2px solid white' : '' }}">
                    Mahasiswa
                </a>
            </li>
            <li>
                <a href="{{ route('student.actortype', 2) }}"
                    style="{{ session('actor') == 2 ? 'border-bottom: 2px solid white' : '' }}">
                    Dosen
                </a>
            </li>
            <li>
                <a href="{{ route('student.actortype', 3) }}"
                    style="{{ session('actor') == 3 ? 'border-bottom: 2px solid white' : '' }}">
                    Alumni
                </a>
            </li>
        </ul>
    </div>
    <div class="mb-4">
        <ul class="bundle_chart mt-3">
            <!-- 1 -->
            <li>
                <a href="{{ route(session('routes')[0], session('actor')) }}"
                    style="{{ session('visual') == 1 ? 'border-bottom: 2px solid black' : '' }}">Keseluruhan</a>
            </li>
            <!-- 2 -->
            <li>
                <a href="{{ route(session('routes')[1], session('actor')) }}"
                    style="{{ session('visual') == 2 ? 'border-bottom: 2px solid black' : '' }}">Statistik</a>
            </li>
            <!-- 3 -->
            <li>
                <a href="{{ route(session('routes')[2], session('actor')) }}"
                    style="{{ session('visual') == 3 ? 'border-bottom: 2px solid black' : '' }}">Perbandingan</a>
            </li>
            <!-- 4 -->
            <li>
                <a href="{{ route(session('routes')[3], session('actor')) }}"
                    style="{{ session('visual') == 4 ? 'border-bottom: 2px solid black' : '' }}">Detail</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="container offset-3 col-6">
        <div class="card">
            <div class="card-body">
                @isset($text)
                    {{ $text }}
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa debitis saepe cum fugiat corrupti fugit hic
                    voluptatem, rem quae. Porro ipsum, quas laborum aspernatur quam, iure unde sit laudantium expedita officiis
                    neque veniam, optio aut soluta? Optio molestiae architecto velit error obcaecati ipsam fuga, aliquid eum?
                    Aut, ex! Quasi fugit quod voluptas dolor, expedita debitis ratione excepturi aperiam officiis assumenda quo
                    doloremque modi necessitatibus
                @endisset
            </div>
        </div>
    </div>
@endsection
