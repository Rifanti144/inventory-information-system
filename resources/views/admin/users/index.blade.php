@extends('layouts.app')

@section('title', 'Manage Users - Inventory Information Systems')

@section('content')
<main class="list-wrap">
  @include('partials.flash')

  <div class="list-card">
    <h2>User Access Management</h2>

    <div class="table-wrap">
      <div class="table-scroll">
        <table class="table-users">
          <thead>
            <tr>
              <th>Username</th>
              <th>Email</th>
              <th>Role</th>
              <th>Can Login</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $u)
              <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td class="col-center">
                  <select name="role" class="table-select" form="user-form-{{ $u->id }}" aria-label="Role for {{ $u->name }}">
                    @foreach (\App\Models\User::ROLES as $role)
                      <option value="{{ $role }}" @selected($u->role === $role)>{{ ucfirst($role) }}</option>
                    @endforeach
                  </select>
                </td>
                <td class="col-center">
                  <input type="checkbox" name="is_active" value="1" class="table-check" form="user-form-{{ $u->id }}" aria-label="Can login: {{ $u->name }}" @checked($u->is_active)>
                </td>
                <td class="col-center">
                  <form id="user-form-{{ $u->id }}" class="inline-form" method="POST" action="{{ route('admin.users.update', $u) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn-edit">Save</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
@endsection
