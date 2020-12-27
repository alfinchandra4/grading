<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="{{ asset('student-css.css') }}">

    <title>@yield('pagetitle')</title>
</head>

<body>
    {{-- HEADER --}}
    <header>
        <nav class="navbar navbar-expand-lg navbar-light"
            style="background-color: yellow; border-bottom:5px solid green">
            <div class="container-fluid container">
                <span class="navbar_brand" style="width: 200px">UPN "Veteran" Jakarta</span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @guest
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 header_menu">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal"
                                    data-bs-target="#login_modal">Log in</a>

                                <!-- Modal -->
                                <div class="modal fade" id="login_modal" tabindex="-1" aria-labelledby="login_modalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header"
                                                style="background-color: yellow; border-bottom:5px solid green">
                                                <h5 class="modal-title" id="login_modalLabel">Log in</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="/login" id="loginFrm">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="identity" class="form-label">NIM / NIDN</label>
                                                        <input type="text" class="form-control" id="identity"
                                                            name="identity">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="password"
                                                            name="password">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" form="loginFrm" class="btn btn-primary">Login</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact Us</a>
                            </li>
                        </ul>
                    @endguest
                    @auth('student')
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 header_menu">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Help</a>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    {{-- MAIN --}}
    <main>
        <div class="profile_">
            <div class="container">
                <span class="user">
                    @yield('user_profile')
                    <div class="float-end">
                        @yield('leftbtn')
                        {{-- <a href="#" class="btn btn-outline-success btn-sm">Report</a>
                        <a href="#" class="btn btn-success btn-sm">Isi kuesioner</a> --}}
                    </div>
                </span>
            </div>
        </div>
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
        <div class="content p-2" style="background-color: #e6e6e6;">
            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="p-4 bg-dark fw-bold text-center" style="color: white">
        Hak Cipta 2020 @ UPN VETERAN JAKARTA
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

</body>

</html>
