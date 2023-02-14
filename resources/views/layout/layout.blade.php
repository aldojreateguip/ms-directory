<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootsrap 4 CDN-->

    <title>@yield('title')</title>
    @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/css/login_styles.css', 'resources/css/header_styles.css'])

</head>

<body>
    @extends('header')
    <div class="main-container">
        @yield('content')
    </div>
</body>

</html>