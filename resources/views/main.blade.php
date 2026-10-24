@extends('layouts.guest')

@section('title', 'Inventory Information Systems')

@section('glows')
  <div class="glow glow--white" aria-hidden="true"></div>
  <div class="glow glow--pink-top" aria-hidden="true"></div>
  <div class="glow glow--pink-bottom" aria-hidden="true"></div>
@endsection

@section('content')
  <section class="hero">
    <h1>Manage your own Inventory Systems</h1>
    <p>Warehousing, Vendors, Items, and Operational</p>
    <a href="#login" class="hero-btn">Register or Login</a>
  </section>

  <section class="login-section" id="login">
    <div class="tagline">
      <span class="tagline-bar" aria-hidden="true"></span>
      <h2>Your Inventory Systems in One Click Away</h2>
    </div>

    <div class="panel panel--login">
      @include('partials.flash')

      <form method="POST" action="{{ route('login.attempt') }}">
        @csrf

        <div class="field">
          <label for="email">Login with Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="e.g, googlemail@gmail.com" required autocomplete="email">
          @error('email') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
          <label for="password">Insert Password</label>
          <input type="password" id="password" name="password" placeholder="e.g, googlemail123" required autocomplete="current-password">
          @error('password') <p class="field-error">{{ $message }}</p> @enderror
        </div>

        <div class="btn-stack" style="margin-top: 52px;">
          <button type="submit" class="btn btn--lime">Login</button>
          <a href="{{ route('register') }}" class="btn btn--outline">Register</a>
        </div>
      </form>
    </div>
  </section>
@endsection
