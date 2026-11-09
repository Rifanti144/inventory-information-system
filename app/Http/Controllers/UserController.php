<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Admin-only page (see the role:admin route group) to change a user's role
 * and to activate / deactivate an account ("who is allowed to log in").
 */
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

        // An admin must not lock themselves out.
        if ($user->is($request->user()) && ($data['role'] !== User::ROLE_ADMIN || ! $isActive)) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot remove your own admin role or deactivate your own account.');
        }

        // role / is_active are not mass-assignable on purpose, so forceFill is used here.
        $user->forceFill(['role' => $data['role'], 'is_active' => $isActive])->save();

        return redirect()->route('admin.users.index')->with('status', 'User access updated.');
    }
}
