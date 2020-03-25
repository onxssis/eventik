<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <link rel="shortcut icon" href="/favicon.png" type="image/png">
    <link rel="icon" href="/favicon.png" type="image/png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('css')

    <script defer src="https://use.fontawesome.com/releases/v5.6.3/js/all.js"
        integrity="sha384-EIHISlAOj4zgYieurP0SdoiBYfGJKkgWedPHH4jCzpCXLmzVsw1ouK59MuUtP4a1" crossorigin="anonymous">
    </script>

    {{-- <script>
        window.App = {
            !!json_encode([
                'authenticated' => Auth::check(),
                'user' => [
                    'id' => Auth::user() ? Auth::user()->id : null,
                    'name' => Auth::user() ? Auth::user()->name : null,
                ],
                'url' => config('app.url')
            ])!!
        }
    </script> --}}

</head>

<body>
    <div id="app">

        @include('home.partials.topbar')

        @include('partials.navbar')

        <main id="@yield('main-class')">
            <router-view></router-view>
            @yield('content')

            @include('modals.all')
        </main>

        @include('partials.footer')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('footer-scripts')

</body>

</html>