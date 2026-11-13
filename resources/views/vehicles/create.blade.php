@extends('layouts.app')

@section('title', 'Add vehicle')

@section('content')
    <div class="page">
        <h1 class="page-title">Operational<br>Fleet<br>Module</h1>

        <div class="card">
            <form action="{{ route('vehicles.store') }}" method="POST">
                @include('vehicles._form')
            </form>
        </div>
    </div>
@endsection