@php
  $modules = \App\Support\Modules::all();
  $current = collect($modules)->first(fn ($m) => request()->routeIs($m['pattern']));
  $openKey = $current['key'] ?? $modules[0]['key'];
@endphp

<div class="sidebar-overlay" id="sidebar-overlay"></div>

<aside class="sidebar" id="sidebar" aria-label="Main navigation" aria-hidden="true">
  <nav>
    @foreach ($modules as $m)
      @php $open = $openKey === $m['key']; @endphp
      <div class="nav-group {{ $open ? 'is-open' : '' }}">
        <button type="button" class="nav-parent" aria-expanded="{{ $open ? 'true' : 'false' }}">
          <span>{{ $m['label'] }}</span>
          <i class="nav-arrow" aria-hidden="true"></i>
        </button>
        <div class="nav-children">
          @foreach (\App\Support\Modules::visibleLinks($m, auth()->user()) as $link)
            <a href="{{ route($link['route']) }}" class="nav-child {{ request()->routeIs($link['route']) ? 'is-current' : '' }}">{{ $link['label'] }}</a>
          @endforeach
        </div>
      </div>
    @endforeach
  </nav>
</aside>
