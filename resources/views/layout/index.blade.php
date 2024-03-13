<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logoipsum</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-100">
    @include('sweetalert::alert')

    @auth
        @include('layout.navbar_auth')    
    @endauth
    @guest
        @include('layout.navbar_guest')
    @endguest
    @yield('container')
</body>
</html>