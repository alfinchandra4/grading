@extends('layouts.app')

@section('pagetitle', 'Report Complaint')

@section('content')
    <div class="container p-3 forms">
        <div class="text-center m-auto h1 fw-bold text-uppercase mt-5" style="color: yellow">
            REPORT
        </div>
        <div class="text-center m-auto fw-bold text-uppercase mt-2" style="color: white">Tingkat Kepuasan Pelayanan</div>
        <div class="text-center m-auto fw-bold text-uppercase" style="color: yellow">
            UPN "VETERAN" JAKARTA
        </div>
        <div class="text-center">
          <ul class="list-group list-group-horizontal col-6 mx-auto justify-content-center" style="margin-top: 100px">
            <a href="{{ route('complain.list', 1) }}" class="list-group-item list-group-item-action {{ session('role') == 1 ? 'bg-warning' : '' }}">Mahasiswa</a>
            <a href="{{ route('complain.list', 2) }}" class="list-group-item list-group-item-action {{ session('role') == 2 ? 'bg-warning' : '' }}">Dosen</a>
            <a href="{{ route('complain.list', 3) }}" class="list-group-item list-group-item-action {{ session('role') == 3 ? 'bg-warning' : '' }}">Alumni</a>
          </ul>
        </div>
        <div class="card mt-2">
          <div class="card-header d-flex justify-content-between">
            <div>
              Pengaduan Mahasiswa
           </div>
           <div>
              <a href="{{ route('student_export') }}" class="text-decoration-none" style="color: black"> <i class="fa fa-file-excel" aria-hidden="true"></i> Lihat laporan  </a>
           </div>
          </div>
            <div class="card-body">
              @if (session('role') == 1)
              <table class="table">
                <thead class="bg-success text-white">
                  <tr>
                    <th>#</th>
                    <th style="width: 200px">Tgl. pengaduan</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Jurusan</th>
                    <th>Title</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                      $users = App\Models\Report::where('user_type', 1)->orderByDesc('created_at')->get();
                  @endphp
                  @foreach ($users as $user)
                    @php
                        $selectedUser = App\Models\Student::find($user->user_id);
                    @endphp
                      <tr style="background: {{ $user->status == 1 ? '#e6e6e6' : '' }}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                        <td>{{ $selectedUser->name }}</td>
                        <td>{{ $selectedUser->nim }}</td>
                        <td>
                          @switch($selectedUser->major)
                              @case(1) S1 Sistem Informasi @break
                              @case(2) S1 Teknik Informatika @break
                              @case(3) D3 Sistem Informasi @break
                          @endswitch
                        </td>
                        <td>
                          <a href="{{route('complain.detail', $user->id) }}" style="text-decoration: none">{{$user->subject}}</a>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
              @endif

              @if (session('role') == 2)
              <table class="table">
                <thead class="bg-success text-white">
                  <tr>
                    <th>#</th>
                    <th style="width: 200px">Tgl. pengaduan</th>
                    <th>Nama</th>
                    <th>NIDN</th>
                    <th>Title</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                      $users = App\Models\Report::where('user_type', 2)->orderByDesc('created_at')->get();
                  @endphp
                  @foreach ($users as $user)
                    @php
                        $selectedUser = App\Models\Lecturer::find($user->user_id);
                    @endphp
                      <tr style="background: {{ $user->status == 1 ? '#e6e6e6' : '' }}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                        <td>{{ $selectedUser->name }}</td>
                        <td>{{ $selectedUser->nidn }}</td>
                        <td>
                          <a href="{{route('complain.detail', $user->id) }}" style="text-decoration: none">{{$user->subject}}</a>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
              @endif

              @if (session('role') == 3)
              <table class="table">
                <thead class="bg-success text-white">
                  <tr>
                    <th>#</th>
                    <th style="width: 200px">Tgl. pengaduan</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th>Title</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                      $users = App\Models\Report::where('user_type', 3)->orderByDesc('created_at')->get();
                  @endphp
                  @foreach ($users as $user)
                    @php
                        $selectedUser = App\Models\Alumni::find($user->user_id);
                    @endphp
                    
                      <tr style="background: {{ $user->status == 1 ? '#e6e6e6' : '' }}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                        <td>{{ $selectedUser->name }}</td>
                        <td>
                          @switch($selectedUser->major)
                              @case(1) S1 Sistem Informasi @break
                              @case(2) S1 Teknik Informatika @break
                              @case(3) D3 Sistem Informasi @break
                          @endswitch
                        </td>
                        <td>{{ $selectedUser->generation }}</td>
                        <td>
                          <a href="{{route('complain.detail', $user->id) }}" style="text-decoration: none">{{$user->subject}}</a>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
              @endif
            </div>
        </div>
    </div>
@endsection
