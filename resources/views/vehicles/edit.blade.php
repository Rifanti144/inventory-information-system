@extends('layouts.app')

@section('title', 'Edit vehicle')

@section('content')
    <div class="page">
        <h1 class="page-title">Edit<br>Vehicle<br>Information</h1>

        <div class="card">
            <form action="{{ route('vehicles.update', $vehicle) }}" method="POST">
                @method('PUT')
                @include('vehicles._form')
            </form>
        </div>
    </div>
@endsection