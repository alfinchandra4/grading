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
    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
        @php
            session()->forget('success');
        @endphp
    @endif

    @if (session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
        @php
            session()->forget('error');
        @endphp
    @endif

    {{-- HEADER --}}
    <header>
        <nav class="navbar navbar-expand-lg navbar-light"
            style="background-color: yellow; box-shadow: 0 2px 4px 0 rgba(0,0,0,.2);">
            <div class="container-fluid container">
                <span class="navbar_brand" style="width: 200px">UPN "Veteran" Jakarta</span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 header_menu">
                        @if (auth('student')->check() || 
                             auth('lecturer')->check() || 
                             auth('alumni')->check() ||
                             auth('administrator')->check() ||
                             auth('dean')->check())
                            <li class="nav-item">
                                <a class="nav-link {{ session('dashboard') == true ? 'active' : '' }}"
                                    href="{{ route('dashboard') }}">Home</a>
                            </li>
                        @else
                            <a href="/" style="text-decoration: none; color: black">Homepage</a>
                        @endif

                        @auth('student')
                            <a class="nav-link {{ Route::currentRouteName() == 'student.profile' ? 'active' : '' }}"
                                href="{{ route('student.profile') }}">Profile</a>
                        @endauth
                        @auth('lecturer')
                            <a class="nav-link {{ Route::currentRouteName() == 'lecturer.profile' ? 'active' : '' }}"
                                href="{{ route('lecturer.profile') }}">Profile</a>
                        @endauth
                        @auth('alumni')
                            <a class="nav-link {{ Route::currentRouteName() == 'alumni.profile' ? 'active' : '' }}"
                                href="{{ route('alumni.profile') }}">Profile</a>
                        @endauth
                        <li class="nav-item">
                        </li>
                        @if (auth('administrator')->check() || auth('dean')->check())
                        <li class="nav-item">
                            <a class="nav-link {{ session('complain') == true ? 'active' : '' }}" 
                               href="{{ route('complain.list', 1) }}">Complains</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            @auth('student')
                                <a class="nav-link" href="/logout/student">Log out</a>
                            @endauth
                            @auth('lecturer')
                                <a class="nav-link" href="/logout/lecturer">Log out</a>
                            @endauth
                            @auth('alumni')
                                <a class="nav-link" href="/logout/alumni">Log out</a>
                            @endauth
                            @auth('dean')
                                <a class="nav-link" href="/logout/dean">Log out</a>
                            @endauth
                            @auth('administrator')
                                <a class="nav-link" href="/logout/administrator">Log out</a>
                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- MAIN --}}
    <main>
        @include('sweetalert::alert')
        @yield('profile')
        @yield('monitor')
        <div class="content" style="background-color: #e6e6e6;">
            @yield('actor-list')
            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="p-4 bg-dark fw-bold text-center" style="color: white">
        Hak Cipta 2020 @ UPN VETERAN JAKARTA
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
    @yield('js-bottom')

</body>

</html>
