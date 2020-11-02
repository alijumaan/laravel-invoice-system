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
    <div id="app">
        <main class="py-4">
            <div class="container">
                @include('partial.flash')
                @yield('content')
            </div>
        </main>
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

