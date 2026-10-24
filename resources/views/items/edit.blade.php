@extends('layouts.app')

@section('title', 'Edit Item - Inventory Information Systems')

@section('content')
<main class="content">
  <div class="intro">
    <span class="accent-bar" aria-hidden="true"></span>
    <h1>Item Catalog Master Data</h1>
  </div>

  <div class="panel">
    <form method="POST" action="{{ route('items.update', $item) }}">
      @csrf
      @method('PUT')
      @include('items._form')
      <div class="form-actions">
        <a href="{{ route('items.index') }}" class="btn btn--cancel">Cancel</a>
        <button type="submit" class="btn btn--lime">SAVE CHANGES</button>
      </div>
    </form>
  </div>
</main>
@endsection
