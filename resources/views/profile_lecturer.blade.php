@extends('layouts.app')

@section('pagetitle', 'Lecturer profile')

@section('content')
    <div class="container p-3 forms">
        <div class="avatar mt-5" style="margin:auto">
            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar">
        </div>
        <div class="username m-auto text-center mt-3 fw-bold text-white">
            {{ auth('lecturer')->user()->name }}
        </div>
        <div class="text-center m-auto h3 fw-bold text-uppercase mt-3" style="color: yellow">
            Profile
            <hr style="width: 120px; height:5px; color:#FFF" class="text-center m-auto" />
        </div>
        <div class="card profile col-8 offset-2 mt-5">
            <form action="" method="POST">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" required value="{{ $lecturer->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="phone">Telepon</label>
                        <input type="text" name="phone" id="phone" class="form-control" required
                            value="{{ $lecturer->phone }}">
                        <div class="form-text">Nomor telepon aktif</div>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required
                            value="{{ $lecturer->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="nidn">NIDN</label>
                        <input type="text" name="nidn" id="nidn" class="form-control" required readonly
                            value="{{ $lecturer->nidn }}">
                    </div>
                    <div class="mb-3">
                        <label for="fac">Fakultas</label>
                        <input type="text" name="fac" id="fac" class="form-control" required readonly value="Ilmu Komputer">
                    </div>
                    <div class="mb-3">
                        <label for="gender">Gender</label>
                        <input type="text" name="gender" id="gender" class="form-control" required readonly
                            value="{{ $lecturer->gender == 1 ? 'Pria' : 'Wanita' }}">
                    </div>
                    <div class="mb-3">
                        <label for="birth">Tempat lahir</label>
                        <input type="text" name="birth" id="birth" class="form-control" required readonly
                            value="{{ $lecturer->birth }}">
                    </div>
                    <div class="mb-3">
                        <label for="dob">Tanggal lahir</label>
                        <input type="date" name="dob" id="dob" class="form-control" required value="{{ $lecturer->dob }}"
                            readonly>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
