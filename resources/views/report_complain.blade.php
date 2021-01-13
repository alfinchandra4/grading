@extends('layouts.app')

@section('pagetitle', 'Report Complaint')

@section('content')
    <div class="container p-3 forms">
        <div class="text-center m-auto h1 fw-bold text-uppercase mt-5" style="color: yellow">
            FORM REPORT
        </div>
        <div class="text-center m-auto fw-bold text-uppercase mt-2" style="color: white">Tingkat Kepuasan Pelayanan</div>
        <div class="text-center m-auto fw-bold text-uppercase" style="color: yellow">
            UPN "VETERAN" JAKARTA
        </div>
        <div class="card" style="margin-top: 100px">
            <div class="card-body">
                <form method="POST" action="">
                    @csrf
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea name="body" id="body" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
