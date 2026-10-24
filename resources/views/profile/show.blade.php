@extends('layouts.app')

@section('title', 'Profile - Inventory Information Systems')

@section('glows')
  <div class="glow glow--pink-small" aria-hidden="true"></div>
@endsection

@section('content')
  <a href="{{ route('dashboard') }}" class="btn btn--outline back-btn">Back</a>

  <h1 class="page-title page-title--tight">Profile Info</h1>

  <div class="panel panel--center">
    @include('partials.flash')

    <form method="POST" action="{{ route('profile.update') }}">
      @csrf
      @method('PUT')

      <div class="field">
        <label for="name">Username</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required maxlength="50">
        @error('name') <p class="field-error">{{ $message }}</p> @enderror
      </div>

      <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email') <p class="field-error">{{ $message }}</p> @enderror
      </div>

      <div class="btn-stack" style="margin-top: 44px;">
        <button type="submit" class="btn btn--lime btn--wide">Save Changes</button>
        <a href="{{ route('profile.password') }}" class="btn btn--outline btn--wide">Change Password</a>
      </div>
    </form>
  </div>

  <div style="height: 70px;"></div>
@endsection
