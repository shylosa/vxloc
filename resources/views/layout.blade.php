<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-light bg-light justify-content-center">
        <a class="navbar-brand" href="/"><span class="mb-0 h1">{{ config('app.name') }}</span></a>
    </nav>
    <div class="container">
        <div class="d-flex justify-content-center">
            @if(Auth::check())
                <a class="m-2 btn btn-dark" href="/logout">Logout</a>
                <a class="m-2 btn btn-dark" href="/phonebook">Public Phonebook</a>
                <a class="m-2 btn btn-dark" href="/mycontact">My Contact</a>
            @else
                <a class="m-2 btn btn-dark" href="/login" id="js-link-login">Login</a>
                <a class="m-2 btn btn-dark" href="/phonebook">Public Phonebook</a>
            @endif
        </div>
        <div id="js-content">
            @yield('content')
        </div>
    </div>
</body>
</html>
