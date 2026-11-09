<header class="topbar topbar--app">
  <button type="button" class="menu-toggle" id="menu-toggle" aria-label="Open menu" aria-controls="sidebar" aria-expanded="false">
    <span></span><span></span><span></span>
  </button>

  @include('partials.logo')

  <div class="user-menu">
    <button type="button" class="user-toggle" id="user-toggle" aria-haspopup="true" aria-expanded="false">
      <span class="avatar" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm0 2c-4.42 0-8 2.24-8 5v2h16v-2c0-2.76-3.58-5-8-5Z"/></svg>
      </span>
      <span class="user-name">{{ auth()->user()->name }}</span>
      <span class="caret" aria-hidden="true"></span>
    </button>

    <div class="user-dropdown" id="user-dropdown" hidden>
      <span style="display:block; padding:8px 16px; font-size:.8rem; opacity:.7;">Role: {{ ucfirst(auth()->user()->role) }}</span>
      <a href="{{ route('profile.show') }}">Profile</a>
      @if (auth()->user()->isAdmin())
        <a href="{{ route('admin.users.index') }}">Manage Users</a>
      @endif
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
      </form>
    </div>
  </div>
</header>
