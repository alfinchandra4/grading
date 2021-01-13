@extends('layouts.app')

@section('pagetitle', 'Form Kuisioner')

@section('content')
    <div class="container p-3 forms">
        <div class="title fw-bold text-center h1 mt-5" style="color: yellow">
            Form Kuisioner
        </div>
        <div class="caption text-center">
            <span style="color: white">
                Tingkat kepuasan pelayanan
            </span>
            <div style="color: yellow">
                UPN VETERAN JAKARTA
            </div>
        </div>
        <div class="rules" style="color: white">
            <div class="offset-1 mt-5 col-6">
                Pilihlah jawaban yang sesuai dengan pendapat Anda pada mengenai tingkat
                kepuasan Anda sebagai customer pada kualitas pelayanan di UPN Veteran Jakarta melalui form dibawah ini,
                dengan keterangan sebagai berikut: <br />
                1 = Sangat Tidak Setuju <br />
                2 = Tidak Setuju </br>
                3 = Cukup Setuju </br>
                4 = Setuju </br>
                5 = Sangat Setuju <br />
            </div>
        </div>
        <div class="card question offset-1 col-10 mt-5">
            <div class="card-body">
                <div class="question-category fw-bold h5">{{ session('category')['category'] }} ({{session('category')['id']}} of 8)</div>
                <div class="question-answer">
                    <form action="{{ route('lecturer.form.store') }}" method="post" id="fillFrm">
                        @csrf
                        <input type="hidden" name="category_id" value="{{ session('category')['id'] }}">
                        @foreach (session('questions') as $key => $q)
                            <div style="margin-left: 25px" class="mb-3">
                                {{ $loop->iteration }}. {{ $q->question }} <br />
                                <span style="margin-left: 50px">
                                    <div class="form-check form-check-inline" style="margin: 0 50px 0 0px">
                                        <input class="form-check-input" type="radio" name="ans[{{ $key }}]" id="{{ $key }}1"
                                            value="1" required {{ isset($answer) && $answer[$key] == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $key }}1">1</label>
                                    </div>

                                    <div class="form-check form-check-inline" style="margin: 0 50px 0 0px">
                                        <input class="form-check-input" type="radio" name="ans[{{ $key }}]" id="{{ $key }}2"
                                            value="2" required {{ isset($answer) && $answer[$key] == 2 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $key }}2">2</label>
                                    </div>

                                    <div class="form-check form-check-inline" style="margin: 0 50px 0 0px">
                                        <input class="form-check-input" type="radio" name="ans[{{ $key }}]" id="{{ $key }}3"
                                            value="3" required {{ isset($answer) && $answer[$key] == 3 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $key }}3">3</label>
                                    </div>

                                    <div class="form-check form-check-inline" style="margin: 0 50px 0 0px">
                                        <input class="form-check-input" type="radio" name="ans[{{ $key }}]" id="{{ $key }}4"
                                            value="4" required {{ isset($answer) && $answer[$key] == 4 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $key }}4">4</label>
                                    </div>
                                </span>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
            <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                @if (session('disablebtn') != true)
                    <a href="{{ route('lecturer.forms', session('backurl')) }}" class="btn btn-outline-success">Back</a>
                @endif
                <button type="submit" class="btn btn-success mr-auto" form="fillFrm">Next</button>
            </div>
        </div>
    </div>
@endsection
