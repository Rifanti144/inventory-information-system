<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', ['users' => User::orderBy('id')->get()]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'role' => ['required', Rule::in(User::ROLES)],
        ]);
        $isActive = $request->boolean('is_active');

        if ($user->is($request->user()) && ($data['role'] !== User::ROLE_ADMIN || ! $isActive)) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot remove your own admin role or deactivate your own account.');
        }

        $user->forceFill(['role' => $data['role'], 'is_active' => $isActive])->save();

        return redirect()->route('admin.users.index')->with('status', 'User access updated.');
    }
}
