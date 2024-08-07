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
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @yield('css')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-center brand-bg">
                    <div class="brand-container">
                        <img src="{{ asset('images/banner-logo.png') }}" alt="logo" class="banner-logo">
                    </div>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                @include('layouts.menu')
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div>@yield('page')</div>
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('images/admin.png') }}" alt="" width="35"
                                        height="35" class="rounded-circle" style="object-fit: cover;" id="adminimg">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="{{ route('user.changepassword') }}"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <p class="mb-0 fs-3"> Change Password</p>
                                        </a>
                                        <a class="dropdown-item btn btn-outline-primary mt-2 d-block"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->

            <div class="container-fluid my-ratio">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('modernize/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('modernize/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('modernize/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('modernize/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('modernize/assets/libs/momentjs/moment.min.js') }}"></script>
    <script src="{{ asset('modernize/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('library/select2/select2.min.js') }}"></script>
    <script src="{{ asset('library/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('library/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('library/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('library/apexchart/apexchart.js') }}"></script>
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
