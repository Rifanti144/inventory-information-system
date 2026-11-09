@extends('layouts.app')

@section('title', 'Vendor / Supplier Data - Inventory Information Systems')

@section('content')
<main class="list-wrap">
  @include('partials.flash')

  <div class="list-card">
    <h2>Vendor and Supplier Data</h2>

    <div class="table-wrap">
      <div class="table-scroll">
        <table>
          <thead>
            <tr>
              <th>Vendor Name</th>
              <th>Office Address</th>
              <th>Company Legality</th>
              <th>PIC Name</th>
              <th>PIC Contact</th>
              <th>Created By</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($vendors as $vendor)
              <tr>
                <td>{{ $vendor->vendor_name }}</td>
                <td>{{ $vendor->office_address }}</td>
                <td>{{ $vendor->company_legality }}</td>
                <td>{{ $vendor->pic_name }}</td>
                <td>{{ $vendor->pic_contact }}</td>
                <td>{{ $vendor->user?->name ?? '-' }}</td>
                <td>
                  @canany(['update', 'delete'], $vendor)
                    <div class="action-buttons">
                      @can('update', $vendor)
                        <a href="{{ route('vendors.edit', $vendor) }}" class="btn-edit">Edit</a>
                      @endcan
                      @can('delete', $vendor)
                        <form method="POST" action="{{ route('vendors.destroy', $vendor) }}" data-confirm="Are you sure you want to delete this vendor?">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn-delete">Delete</button>
                        </form>
                      @endcan
                    </div>
                  @else
                    -
                  @endcanany
                </td>
              </tr>
            @empty
              <tr class="empty-row"><td colspan="7">No vendors added yet.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    @can('create', \App\Models\Vendor::class)
      <a href="{{ route('vendors.create') }}" class="btn-add">Add Another Vendor</a>
    @endcan
  </div>
</main>
@endsection
