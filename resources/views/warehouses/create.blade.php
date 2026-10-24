@extends('layouts.app')

@section('title', 'Add Warehouse - Inventory Information Systems')

@section('content')
<main class="content">
  <div class="intro">
    <span class="accent-bar" aria-hidden="true"></span>
    <h1>Warehouse Zoning and Rack</h1>
  </div>

  <div class="panel">
    <form method="POST" action="{{ route('warehouses.store') }}">
      @csrf
      @include('warehouses._form')
      <div class="form-actions">
        <button type="submit" class="btn btn--lime">SAVE</button>
      </div>
    </form>
  </div>
</main>
@endsection
