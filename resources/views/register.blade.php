@extends('layouts.guest')

@section('title', 'Register - Inventory Information Systems')

@section('glows')
  <div class="glow glow--pink-small" aria-hidden="true"></div>
@endsection

@section('content')
  <h1 class="page-title">Register Here!</h1>

  <div class="panel panel--center">
    <form method="POST" action="{{ route('register.store') }}">
      @csrf

      <div class="field">
        <label for="name">Insert Username</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required maxlength="50" autocomplete="username">
        @error('name') <p class="field-error">{{ $message }}</p> @enderror
      </div>

      <div class="field">
        <label for="email">Insert Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email') <p class="field-error">{{ $message }}</p> @enderror
      </div>

      <div class="field">
        <label for="password">Insert Password</label>
        <input type="password" id="password" name="password" required minlength="8" autocomplete="new-password">
        @error('password') <p class="field-error">{{ $message }}</p> @enderror
      </div>

      <div class="field">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
      </div>

      <div class="panel-actions">
        <button type="submit" class="btn btn--outline">Register</button>
      </div>
      <p class="panel-link">Already have an account? <a href="{{ route('login') }}#login">Login</a></p>
    </form>
  </div>

  <div class="page-end-space"></div>
@endsection
