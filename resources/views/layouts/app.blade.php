<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @yield('styles')
    
</head>
<body>

@include('layouts/navbar')
@yield('content')


    <script src="{{ asset('js/scripts.js') }}"></script>
    @yield('scripts')
</body>

<footer>
    <img class="img2" src="{{ asset('img/logo.png') }}" alt="Basic Course Kraft Logo">
    <p>Copyright &copy; 2024 CourseKraft. All rights reserved. <br></p>
</footer>
</html>
