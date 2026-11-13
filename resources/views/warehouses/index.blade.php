@extends('layouts.app')

@section('title', 'Warehouse Zoning & Rack Data - Inventory Information Systems')

@section('content')
<main class="list-wrap">
  @include('partials.flash')

  <div class="list-card">
    <h2>Warehouse Zoning &amp; Rack Data</h2>

    <div class="table-wrap">
      <div class="table-scroll">
        <table>
          <thead>
            <tr>
              <th>Warehouse Name</th>
              <th>Aisle Number</th>
              <th>Rack Code</th>
              <th>Physical Capacity</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($warehouses as $warehouse)
              <tr>
                <td>{{ $warehouse->warehouse_name }}</td>
                <td>{{ $warehouse->aisle_number }}</td>
                <td>{{ $warehouse->rack_code }}</td>
                <td>{{ $warehouse->physical_capacity }}</td>
                <td>
                  <div class="action-buttons">
                    <a href="{{ route('warehouses.edit', $warehouse) }}" class="btn-edit">Edit</a>
                    <form method="POST" action="{{ route('warehouses.destroy', $warehouse) }}" data-confirm="Are you sure you want to delete this warehouse?">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn-delete">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr class="empty-row"><td colspan="5">No warehouses added yet.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <a href="{{ route('warehouses.create') }}" class="btn-add">Add Another Warehouse</a>
  </div>
</main>
@endsection
