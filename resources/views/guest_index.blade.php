@extends('layouts.app')

@section('pagetitle', 'Dashboard')

@section('user_profile', 'Alfin Chandra | 15015012005')

@section('profile')
    <div class="profile_">
        <div class="container">
            <span class="user">
                Guest Dashboard
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
                <a href="{{ route('guest.actortype', 1) }}"
                    style="{{ session('actor') == 1 ? 'border-bottom: 2px solid white' : '' }}">
                    Mahasiswa
                </a>
            </li>
            <li>
                <a href="{{ route('guest.actortype', 2) }}"
                    style="{{ session('actor') == 2 ? 'border-bottom: 2px solid white' : '' }}">
                    Dosen
                </a>
            </li>
            <li>
                <a href="{{ route('guest.actortype', 3) }}"
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
                @if (session('visual') == 1)
                <span id="caption">
                    <div class="">Puas: {!! $percentage['agree'] !!} %</div>
                    <div class="">Tidak puas: {!! $percentage['disagree'] !!} %</div>
                </span>
                @endif
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
                            data: [{!!$percentage['agree'] !!},
                             {!!$percentage['disagree'] !!}],
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
                        text: 'Statistik'
                    }
                }
            });

        </script>
    @endsection
@endif

@if (session('visual') == 3)
    @section('js-bottom')
        <script>
            console.log({{ $data }});
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["S1 SI", "S1 TI", "D3 SI"],
                    datasets: [{
                        // label: '# of Votes',
                        data: {!! $data !!},
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
                label: 'Detail kategori',
                data: {!! $max !!},
                backgroundColor: {!! $color !!},
            };

            var barChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: {!! $labels !!},
                    datasets: [densityData],
                },
                options: {
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

        </script>
    @endsection
@endif