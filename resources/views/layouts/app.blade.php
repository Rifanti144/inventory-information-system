<!DOCTYPE html>
<html lang="en">
<head>
@include('partials.head')
</head>
<body>
<div class="page">
  @yield('glows')

  @include('partials.header-app')

  <div class="page-main" id="page-main">
    @yield('content')
  </div>
</div>

@include('partials.sidebar')
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
