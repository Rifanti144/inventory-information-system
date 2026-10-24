@extends('layouts.app')

@section('title', 'Add Item - Inventory Information Systems')

@section('content')
<main class="content">
  <div class="intro">
    <span class="accent-bar" aria-hidden="true"></span>
    <h1>Item Catalog Master Data</h1>
  </div>

  <div class="panel">
    <form method="POST" action="{{ route('items.store') }}">
      @csrf
      @include('items._form')
      <div class="form-actions">
        <button type="submit" class="btn btn--lime">SAVE</button>
      </div>
    </form>
  </div>
</main>
@endsection
