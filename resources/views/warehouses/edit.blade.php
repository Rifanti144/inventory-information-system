@extends('layouts.app')

@section('title', 'Edit Warehouse - Inventory Information Systems')

@section('content')
<main class="content">
  <div class="intro">
    <span class="accent-bar" aria-hidden="true"></span>
    <h1>Edit Warehouse</h1>
  </div>

  <div class="panel">
    <form method="POST" action="{{ route('warehouses.update', $warehouse) }}">
      @csrf
      @method('PUT')
      @include('warehouses._form')
      <div class="form-actions">
        <a href="{{ route('warehouses.index') }}" class="btn btn--cancel">Cancel</a>
        <button type="submit" class="btn btn--lime">UPDATE</button>
      </div>
    </form>
  </div>
</main>
@endsection
