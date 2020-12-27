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
    @include('sweetalert::alert')
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
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Help</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout/student">Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- MAIN --}}
    <main>
        @yield('profile')
        @yield('monitor')
        <div class="content" style="background-color: #e6e6e6; min-height: 700px;">
            @yield('actor-list')
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
