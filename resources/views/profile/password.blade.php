@extends('layouts.app')

@section('title', 'Change Password - Inventory Information Systems')

@section('glows')
  <div class="glow glow--pink-small" aria-hidden="true"></div>
@endsection

@section('content')
  <a href="{{ route('profile.show') }}" class="btn btn--outline back-btn">Back</a>

  <h1 class="page-title page-title--tight">Change your Password</h1>

  <div class="panel panel--center">
    <form method="POST" action="{{ route('profile.password.update') }}">
      @csrf
      @method('PUT')

      <div class="field">
        <label for="password">Insert New Password</label>
        <input type="password" id="password" name="password" required minlength="8" autocomplete="new-password">
        @error('password') <p class="field-error">{{ $message }}</p> @enderror
      </div>

      <div class="field">
        <label for="password_confirmation">Confirm New Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
      </div>

      <div class="panel-actions">
        <button type="submit" class="btn btn--outline">Save</button>
      </div>
    </form>
  </div>

  <div style="height: 70px;"></div>
@endsection
