<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Vehicle Manager')</title>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@500;600;700;800&family=Saira+Condensed:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/IIS.css') }}">
</head>
<body>
    <header class="topbar">
        <img src="{{ asset('Group 18.png') }}" alt="IIS logo">
    </header>

    @if (session('success'))
        <div class="flash"><div>{{ session('success') }}</div></div>
    @endif

    @yield('content')
</body>
</html>
