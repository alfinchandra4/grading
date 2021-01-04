@extends('layouts.app')

@section('pagetitle', 'Dashboard')

@section('user_profile', 'Alfin Chandra | 15015012005')

@section('profile')
    <div class="profile_">
        <div class="container">
            <span class="user">
                @auth('student')
                    {{ auth('student')->user()->name }} - {{ auth('student')->user()->nim }}
                @endauth
                @auth('lecturer')
                    {{ auth('lecturer')->user()->name }} - {{ auth('lecturer')->user()->nidn }}
                @endauth
                @auth('alumni')
                    {{ auth('alumni')->user()->name }} - {{ auth('alumni')->user()->nim }}
                @endauth
                <div class="float-end">
                    <a href="#" class="btn btn-outline-success btn-sm">Report</a>
                    @auth('student')
                        <a href="{{ route('student.forms', 1) }}" class="btn btn-success btn-sm">Isi kuesioner</a>
                    @endauth
                    @auth('lecturer')
                        <a href="{{ route('lecturer.forms', 1) }}" class="btn btn-success btn-sm">Isi kuesioner</a>
                    @endauth
                    @auth('alumni')
                        <a href="{{ route('alumni.forms', 1) }}" class="btn btn-success btn-sm">Isi kuesioner</a>
                    @endauth
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
                            <div class="card-value">
                                {{ App\Models\Student::count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-monitor total_lecturer border-0">
                        <div class="card-body">
                            <span class="card-total">Total Dosen</span>
                            <div class="card-value">
                                {{ App\Models\Lecturer::count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-monitor total_alumni border-0">
                        <div class="card-body">
                            <span class="card-total">Total Alumni</span>
                            <div class="card-value">
                                {{ App\Models\Alumni::count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-monitor total_responses border-0">
                        <div class="card-body">
                            <span class="card-total">Total Responden</span>
                            <div class="card-value">
                                @php
                                $students_count = DB::table('sq_answers')->select(DB::raw('count(student_id) as
                                student'))->groupBy('student_id')->get()->count();
                                $lecturers_count = DB::table('lq_answers')->select(DB::raw('count(lecturer_id) as
                                lecturer'))->groupBy('lecturer_id')->get()->count();
                                $alumnus_count = DB::table('aq_answers')->select(DB::raw('count(alumni_id) as
                                alumni'))->groupBy('alumni_id')->get()->count();
                                @endphp
                                {{ $students_count + $lecturers_count + $alumnus_count }}
                            </div>
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
                <a href="{{ route('actortype', 1) }}"
                    style="{{ session('actor') == 1 ? 'border-bottom: 2px solid white' : '' }}">
                    Mahasiswa
                </a>
            </li>
            <li>
                <a href="{{ route('actortype', 2) }}"
                    style="{{ session('actor') == 2 ? 'border-bottom: 2px solid white' : '' }}">
                    Dosen
                </a>
            </li>
            <li>
                <a href="{{ route('actortype', 3) }}"
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
            @if (session('actor') != 2)
                <!-- 3 -->
                <li>
                    <a href="{{ route(session('routes')[2], session('actor')) }}"
                        style="{{ session('visual') == 3 ? 'border-bottom: 2px solid black' : '' }}">Perbandingan</a>
                </li>
            @endif
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
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@if (session('visual') == 1)
    @section('js-bottom')
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: [
                            "Puas",
                            "Tidak Puas",
                        ],
                        datasets: [{
                            data: [{!!$percentage['agree'] !!}, {!!$percentage['disagree'] !!}],
                            backgroundColor: [
                                "#f37121",
                                "#d9534f",
                            ]
                        }]
                    },
                    options: {}
                }

            );

        </script>
    @endsection
@endif

@if (session('visual') == 2)
    @section('js-bottom')
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!!$years!!}, // years
                    datasets: [{
                        label: "{{ $person }}",
                        data: {!!$total!!}, //student numbers
                        borderColor: 'blue',
                        fill: false
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'World population per region (in millions)'
                    }
                }
            });

        </script>
    @endsection
@endif

@if (session('visual') == 3)
    @section('js-bottom')
        <script>
            console.log("{{ $data }}");
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["SI", "TI", "MI"],
                    datasets: [{
                        // label: '# of Votes',
                        data: {!!$data!!},
                        backgroundColor: [
                            '#f37121',
                            '#ff7b54',
                            '#db6400',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    }
                }
            });

        </script>
    @endsection
@endif

@if (session('visual') == 4)
    @section('js-bottom')
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var densityData = {
                label: 'Density of Planets (kg/m3)',
                data: [5427, 5243, 5514, 3933, 1326, 687, 1271, 1638],
                backgroundColor: [
                    'rgba(0, 99, 132, 0.6)',
                    'rgba(30, 99, 132, 0.6)',
                    'rgba(60, 99, 132, 0.6)',
                    'rgba(90, 99, 132, 0.6)',
                    'rgba(120, 99, 132, 0.6)',
                    'rgba(150, 99, 132, 0.6)',
                    'rgba(180, 99, 132, 0.6)',
                    'rgba(210, 99, 132, 0.6)',
                    'rgba(240, 99, 132, 0.6)'
                ],
                borderColor: [
                    'rgba(0, 99, 132, 1)',
                    'rgba(30, 99, 132, 1)',
                    'rgba(60, 99, 132, 1)',
                    'rgba(90, 99, 132, 1)',
                    'rgba(120, 99, 132, 1)',
                    'rgba(150, 99, 132, 1)',
                    'rgba(180, 99, 132, 1)',
                    'rgba(210, 99, 132, 1)',
                    'rgba(240, 99, 132, 1)'
                ],
                borderWidth: 2,
                hoverBorderWidth: 0
            };

            var chartOptions = {
                scales: {
                    yAxes: [{
                        barPercentage: 0.5
                    }]
                },
                elements: {
                    rectangle: {
                        borderSkipped: 'left',
                    }
                }
            };

            var barChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: ["Mercury", "Venus", "Earth", "Mars", "Jupiter", "Saturn", "Uranus", "Neptune"],
                    datasets: [densityData],
                },
                options: chartOptions
            });

        </script>
    @endsection
@endif
