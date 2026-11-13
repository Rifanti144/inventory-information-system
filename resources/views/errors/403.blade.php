@extends(auth()->check() ? 'layouts.app' : 'layouts.guest')

@section('title', 'Access Denied - Inventory Information Systems')

@section('content')
<main class="list-wrap">
  <div class="list-card">
    <h2>403 - Access Denied</h2>
    <p>{{ $exception->getMessage() ?: 'You do not have permission to open this page.' }}</p>
    <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="btn-add">Back</a>
  </div>
</main>
@endsection
