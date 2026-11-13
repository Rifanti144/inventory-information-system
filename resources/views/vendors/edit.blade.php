@extends('layouts.app')

@section('title', 'Edit Vendor - Inventory Information Systems')

@section('content')
<main class="content">
  <div class="intro">
    <span class="accent-bar" aria-hidden="true"></span>
    <h1>Edit Vendor and Supplier Information</h1>
  </div>

  <div class="panel">
    <form method="POST" action="{{ route('vendors.update', $vendor) }}">
      @csrf
      @method('PUT')
      @include('vendors._form')
      <div class="form-actions">
        <a href="{{ route('vendors.index') }}" class="btn btn--cancel">Cancel</a>
        <button type="submit" class="btn btn--lime">SAVE CHANGES</button>
      </div>
    </form>
  </div>
</main>
@endsection
