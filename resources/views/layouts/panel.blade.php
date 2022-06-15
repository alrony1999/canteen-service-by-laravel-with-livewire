<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NJUST Campus Canteen</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/njust-logo.png') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flexslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chosen.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-01.css') }}">
    @livewireStyles
</head>

<body class="home-page home-01 ">

    <!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#">x</a>
        </div>
        <div class="mercado-panels"></div>
    </div>

    <!--header-->
    <header id="header" class="header header-style-1">
        <div class="container-fluid">
            <div class="row">
                <div class="topbar-menu-area">
                    <div class="container">
                        <div class="topbar-menu left-menu">
                            <ul>
                                <li class="menu-item">
                                    <a title="Hotline: (+123) 456 789" href="#"><span
                                            class="icon label-before fa fa-mobile"></span>Hotline: (+880) 1786129411</a>
                                </li>
                            </ul>
                        </div>
                        <div class="topbar-menu right-menu">
                            <ul>
                                @if (Route::has('login'))
                                    @auth
                                        @if (Auth::user()->utype === 'A')
                                            <a title="Admin Dashboard" href="{{ route('admin.dashboard') }}">Admin
                                                Dashboard</a>
                                        @elseif (Auth::user()->utype === 'S')
                                            <a title="Seller Dashboard" href="{{ route('seller.dashboard') }}">Seller
                                                Dashboard</a>
                                        @elseif (Auth::user()->utype === 'C')
                                            <li class="menu-item menu-item-has-children parent">
                                                <a title="My Account" href="#">{{ Auth::user()->name }}<i
                                                        class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                <ul class="submenu curency">
                                                    <li class="menu-item">
                                                        <a class="btn btn-info" title="My Profile"
                                                            href="{{ route('profile') }}">My
                                                            Profile</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a class="btn btn-info" title="Dashboard"
                                                            href="{{ route('user.dashboard') }}">Dashboard</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a class="btn btn-info" title="my orders"
                                                            href="{{ route('user.orders') }}">My
                                                            Orders</a>
                                                    </li>
                                                    <li class="menu-item">
                                                        <a class="btn btn-info" title="Change Password"
                                                            href="{{ route('changepassword') }}">Change Password</a>

                                                    </li>

                                                    <li class="menu-item">
                                                        <a class="btn btn-info" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endif

                                    @endauth
                                @endif

                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf

                                </form>


                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </header>
    {{ $slot }}

    <script src="{{ asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flexslider.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('assets/js/functions.js') }}"></script>

    @livewireScripts
</body>

</html>
