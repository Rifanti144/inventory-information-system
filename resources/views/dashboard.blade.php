@extends('layouts.app')

@section('title', 'Dashboard - Inventory Information Systems')

@section('glows')
  <div class="glow glow--white" aria-hidden="true"></div>
  <div class="glow glow--pink-top" aria-hidden="true"></div>
@endsection

@section('content')
  <section class="hero">
    <h1>Manage your own Inventory Systems</h1>
    <p>Warehousing, Vendors, Items, and Operational</p>
    <a href="#modules" class="hero-btn">Start to Add Data</a>
  </section>

  <section class="cards" id="modules">
    @foreach (\App\Support\Modules::all() as $m)
      <article class="card">
        <div class="card-head">
          <div class="card-icon">
            <img src="{{ asset('images/' . $m['icon']) }}" width="{{ $m['icon_width'] }}" alt="">
          </div>
          <h2 class="card-title">{{ $m['label'] }}</h2>
        </div>

        <div class="card-actions">
          <a href="{{ route($m['links'][0]['route']) }}" class="card-btn card-btn--add">{{ $m['links'][0]['label'] }}</a>
          <a href="{{ route($m['links'][1]['route']) }}" class="card-btn card-btn--view">{{ $m['links'][1]['label'] }}</a>
        </div>
      </article>
    @endforeach
  </section>
@endsection
