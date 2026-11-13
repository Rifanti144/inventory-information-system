@extends('layouts.app')

@section('title', 'Vehicle Data')

@section('content')
    <div class="wrap">
        <div class="card">
            <h1 class="card-title">Vehicle Data</h1>

            <form method="GET" class="toolbar">
                <input type="search" name="q" class="field" value="{{ request('q') }}"
                       placeholder="Search serial number">
                <select name="status" class="field" onchange="this.form.submit()">
                    <option value="">All statuses</option>
                    @foreach ($statuses as $s)
                        <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </form>

            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->serial }}</td>
                            <td>{{ ucfirst($vehicle->type) }}</td>
                            <td>{{ ucfirst($vehicle->status) }}</td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('vehicles.edit', $vehicle) }}" class="btn btn-sm">Edit</a>
                                    <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST"
                                          onsubmit="return confirm('Delete {{ $vehicle->serial }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-dark">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty">No vehicles found.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $vehicles->links('pagination::simple-default') }}

            <div class="below-table">
                <a href="{{ route('vehicles.create') }}" class="btn">Add Another Vehicle</a>
            </div>
        </div>
    </div>
@endsection