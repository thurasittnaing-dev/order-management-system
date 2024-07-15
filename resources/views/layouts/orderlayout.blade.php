<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('modernize/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('library/tabler/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
        .nav-pills .nav-link {
            border-radius: 0 !important;
        }

        .main-page {
            min-height: 100vh;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="d-flex main-page">
        <div class="d-flex flex-column flex-shrink-0 bg-light" style="width: 8rem;">
            <a href="{{ route('rooms') }}" class="d-block p-3 link-dark text-decoration-none" title="Icon-only"
                data-bs-toggle="tooltip" data-bs-placement="right">
                <img src="{{ asset('images/logo.png') }}" class="order-logo2" alt="">
                <span class="visually-hidden">Icon-only</span>
            </a>
            <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
                <li class="nav-item">
                    <a href="{{ route('rooms') }}" class="nav-link {{ singleMenuActive('rooms') }} py-3 border-bottom"
                        aria-current="page" title="Home" data-bs-toggle="tooltip" data-bs-placement="right">
                        Rooms
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('inuseTable') }} " class="nav-link {{ singleMenuActive('inuseTable') }} py-3 border-bottom"
                        aria-current="page" title="Home" data-bs-toggle="tooltip" data-bs-placement="right">
                        Inuse Tables
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('orderHistory') }}  " class="nav-link {{ singleMenuActive('orderHistory') }} py-3 border-bottom"
                        aria-current="page" title="Home" data-bs-toggle="tooltip" data-bs-placement="right">
                        History
                    </a>
                </li>
            </ul>
            <div class="dropdown border-top">
                <a href="#"
                    class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle"
                    id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('images/admin.png') }}" alt="mdo" width="35" height="35"
                        style="object-fit: cover;" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign
                            out</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>

        <div class="container-fluid my-ratio">
            <div class="mt-4">
                @yield('content')
            </div>
        </div>
    </div>




    <script src="{{ asset('modernize/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('modernize/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('modernize/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('modernize/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('modernize/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('library/select2/select2.min.js') }}"></script>
    <script src="{{ asset('library/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('library/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('library/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        @if (Session::has('success'))
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ Session::get('success') }}",
                showConfirmButton: true,
                timer: 2500
            });
        @endif

        @if (Session::has('error'))
            Swal.fire({
                position: "center",
                icon: "error",
                title: "{{ Session::get('error') }}",
                showConfirmButton: true,
                timer: 5000
            });
        @endif
    </script>
    @yield('js')
</body>

</html>
