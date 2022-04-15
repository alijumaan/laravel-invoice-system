<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{config('app.direction')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ __('Frontend/frontend.Invoice_system') }} | @yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @if(config('app.locale') == 'ar')
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-rtl.css') }}">
    @endif

    @yield('style')
</head>
<body>

<!-- Navigation -->
<nav class="navbar bg-light navbar-light navbar-expand-lg">
    <div class="container">

        <a href="{{route('home')}}" class="navbar-brand"><img src="#" alt="" title="Logo">{{ __('Frontend/frontend.Invoice_system') }}</a>
        <a href="tel:+966501234567" class="text-secondary">{{ __('Frontend/frontend.Call_us_at') }} (9665********)</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                @if(config('app.locale') == 'ar')
                <li class="nav-item active">
                    <a href="{{ route('change_locale', 'en') }}" class="nav-link"><img src="{{ asset('frontend/img/en.png') }}" alt="" style="width: 20px;"></a>
                </li>
                @else
                <li class="nav-item active">
                    <a href="{{ route('change_locale', 'ar') }}" class="nav-link"><img src="{{ asset('frontend/img/ar.png') }}" alt="" style="width: 20px;"></a>
                </li>
                @endif
                @guest
                    <li class="nav-item active"><a href="{{ route('login') }}" class="nav-link">{{__('Frontend/frontend.Login')}}</a></li>
                    @if (Route::has('register'))
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">{{__('Frontend/frontend.Register')}}</a></li>
                    @endif
                @else
                    <li class="nav-item"><a href="{{url('/')}}" class="nav-link">{{__('Frontend/frontend.Home')}}</a></li>

                    <li class="nav-item mr-0"><a href="{{url('/logout')}}" class="nav-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                            {{ __('Frontend/frontend.Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<!-- End Navigation -->

<div id="app">
    <main class="py-4">
        <div class="container">
            @include('partial.flash')
            @yield('content')
        </div>
    </main>
    <!-- Start Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-md-8 col-lg-6"></div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Start Socket -->
    <div class="text-center py-3">
        <p>Created by <span class="text-primary "><a href="https://alialqahtani.sa" target="_blank">Ali</a></span></p>
    </div>
    <!-- End Socket -->
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('frontend/js/fontawesome/all.min.js') }}"></script>
<script>
    $(function () {
        $('#alert-message').fadeTo(2000, 500).slideUp(500, function () {
            $('#alert-message').slideUp(500);
        })
    })
</script>
@yield('script')
</body>
</html>

