<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script defer src="https://use.fontawesome.com/releases/v5.6.3/js/all.js" integrity="sha384-EIHISlAOj4zgYieurP0SdoiBYfGJKkgWedPHH4jCzpCXLmzVsw1ouK59MuUtP4a1"
        crossorigin="anonymous"></script>

</head>

<body>
    @include('home.partials.topbar')
    @include('home.partials.navbar')
    @include('home.partials.hero')
    @include('home.partials.featured')

</body>

</html>