@extends('layouts.app')

@section('title', 'Manage Users - Inventory Information Systems')

@section('content')
<style>
  .list-card {
    --navy: #0d1b45;
    --shadow-blue: #1e3a78;
    --lime: #e0ff66;
  }

  .list-card table td {
    vertical-align: middle !important;
  }
  .center-cell {
    text-align: center;
  }

  /* Dropdown Role: gaya sama dengan dropdown Select Category */
  .role-select {
    -webkit-appearance: none;
    appearance: none;
    min-width: 150px;
    padding: 12px 46px 12px 22px;
    font-family: var(--font-ui);;
    font-size: 1.05rem;
    font-weight: 700;
    color: #3b4a7a;
    background-color: #fff;
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='16' height='10' viewBox='0 0 16 10'><path d='M1.5 1.5l6.5 6.5 6.5-6.5' fill='none' stroke='%230d1b45' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/></svg>");
    background-repeat: no-repeat;
    background-position: right 18px center;
    border: 2px solid var(--navy);
    border-radius: 999px;
    box-shadow: 5px 5px 0 var(--shadow-blue);
    cursor: pointer;
    transition: box-shadow .15s, transform .15s;
  }
  .role-select:hover {
    transform: translate(1px, 1px);
    box-shadow: 4px 4px 0 var(--shadow-blue);
  }
  .role-select:focus {
    outline: none;
    border-color: #fff;
    box-shadow: 0 0 0 4px var(--lime), 5px 5px 0 4px var(--shadow-blue);
  }

  /* Checkbox Can Login: kotak membulat, gaya sama */
  .login-check {
    -webkit-appearance: none;
    appearance: none;
    width: 34px;
    height: 34px;
    margin: 0;
    display: inline-block;
    vertical-align: middle;
    background-color: #fff;
    background-repeat: no-repeat;
    background-position: center;
    background-size: 20px;
    border: 2px solid var(--navy);
    border-radius: 12px;
    box-shadow: 4px 4px 0 var(--shadow-blue);
    cursor: pointer;
    transition: box-shadow .15s, transform .15s, background-color .15s;
  }
  .login-check:hover {
    transform: translate(1px, 1px);
    box-shadow: 3px 3px 0 var(--shadow-blue);
  }
  .login-check:checked {
    background-color: var(--lime);
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path d='M4 10.5l4 4 8-9' fill='none' stroke='%230d1b45' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'/></svg>");
  }
  .login-check:focus-visible {
    outline: none;
    box-shadow: 0 0 0 4px var(--lime), 4px 4px 0 4px var(--shadow-blue);
  }

  /* Tombol Save */
  .action-cell {
    text-align: center;
  }
  .action-cell form {
    margin: 0;
    display: flex;
    justify-content: center;
    width: 100%;
  }
  .action-cell .btn-edit {
    margin: 0;
  }
</style>

<main class="list-wrap">
  @include('partials.flash')

  <div class="list-card">
    <h2>User Access Management</h2>

    <div class="table-wrap">
      <div class="table-scroll">
        <table>
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
                <td class="center-cell">
                  <select name="role" class="role-select" form="user-form-{{ $u->id }}">
                    @foreach (\App\Models\User::ROLES as $role)
                      <option value="{{ $role }}" @selected($u->role === $role)>{{ ucfirst($role) }}</option>
                    @endforeach
                  </select>
                </td>
                <td class="center-cell">
                  <input type="checkbox" name="is_active" value="1" class="login-check" form="user-form-{{ $u->id }}" @checked($u->is_active)>
                </td>
                <td class="action-cell">
                  <form id="user-form-{{ $u->id }}" method="POST" action="{{ route('admin.users.update', $u) }}">
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