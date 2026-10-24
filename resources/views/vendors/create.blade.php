@extends('layouts.app')

@section('title', 'Add Vendor - Inventory Information Systems')

@section('content')
<main class="content">
  <div class="intro">
    <span class="accent-bar" aria-hidden="true"></span>
    <h1>Vendor and Supplier Information</h1>
  </div>

  <div class="panel">
    <form method="POST" action="{{ route('vendors.store') }}">
      @csrf
      @include('vendors._form')
      <div class="form-actions">
        <button type="submit" class="btn btn--lime">SAVE</button>
      </div>
    </form>
  </div>
</main>
@endsection
