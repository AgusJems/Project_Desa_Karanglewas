<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    {{-- njukut nama page karo nama aplikasi --}}
    <title>@yield('title') | @yield('appName')</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    {{-- njukut plugin_css sekang page --}}
    @stack('plugins_css')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body>
    <div id="app">
        {{-- nek page set content_2 panggil page --}}
        @hasSection('content_2')
            @yield('content_2')
        @else
            <div class="main-wrapper">
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Bukti Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body text-center">
                            <img class="mb-2" id="billImage" width="450px">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar">
                    <form class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                        class="fas fa-bars"></i></a></li>
                        </ul>
                    </form>
                    <ul class="navbar-nav navbar-right">
                        <li class="dropdown"><a href="#" class="nav-link nav-link-lg nav-link-user">
                                <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="main-sidebar sidebar-style-2">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <a href="{{ route('user.index') }}">Website Desa</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="{{ route('user.index') }}">WD</a>
                        </div>
                        {{-- njukut tampilan menu --}}
                        @include('layouts.menu')
                        <!-- {% include "layouts/menu.html" %} -->
                    </aside>
                </div>

                <!-- Main Content -->
                <div class="main-content">
                    @yield('content')
                </div>
                <footer class="main-footer">
                    <div class="footer-left">
                        Desa Karanglewas 2022 <div class="bullet"></div> By <a href="#">Jwaadul</a>
                    </div>
                    <div class="footer-right">
                        version
                    </div>
                </footer>
            </div>
        @endif
    </div>

    <!-- General JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    {{-- njukut plugin_js sekang page --}}
    <!-- JS Libraies -->
    @stack('plugins_js')

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    {{-- njukut page_js sekang page --}}
    <!-- Page Specific JS File -->
    @stack('page_js')
</body>

</html>
