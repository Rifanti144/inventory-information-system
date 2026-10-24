<!DOCTYPE html>
<html lang="en">
<head>
@include('partials.head')
</head>
<body>
<div class="page">
  @yield('glows')

  <header class="topbar">
    @include('partials.logo')
  </header>

  <div class="page-main" id="page-main">
    @yield('content')
  </div>
</div>
</body>
</html>
