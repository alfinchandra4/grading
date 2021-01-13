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
        <div class="card" style="margin-top: 100px">
            <div class="card-body">
              <div class="mb-3">
                  <label for="subject" class="form-label">Subject</label>
                  <input type="text" class="form-control" value="{{$data->subject}}" readonly>
              </div>
              <div class="mb-3">
                  <label for="body" class="form-label">Body</label>
                  <textarea name="body" id="body" cols="30" rows="10" class="form-control" readonly>{{$data->body}}</textarea>
              </div>
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('complain.list', 1) }}" class="btn btn-outline-secondary gap-2 d-md-block">Kembali</a>
                @auth('administrator')
                <a href="{{ route('complain.remove', $data->id) }}" class="btn btn-danger">Hapus</a>
                @if ($data->status == 1)
                    <button type="button" class="btn btn-primary disabled">Feedback</button>
                @else
                    <a href="{{ route('complain.received', $data->id) }}" class="btn btn-primary">Feedback</a>
                @endif
                @endauth
              </div>
            </div>
        </div>
    </div>
@endsection
