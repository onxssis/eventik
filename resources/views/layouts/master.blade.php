<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script defer src="https://use.fontawesome.com/releases/v5.6.3/js/all.js" integrity="sha384-EIHISlAOj4zgYieurP0SdoiBYfGJKkgWedPHH4jCzpCXLmzVsw1ouK59MuUtP4a1"
        crossorigin="anonymous"></script>

</head>

<body>
    <div id="app">
        
        @if (! Request::is('/'))
        
            @include('partials.navbar')
        
        @endif

       <main id="@yield('main-class')">
            @yield('content')
       </main>

        @include('partials.footer')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>