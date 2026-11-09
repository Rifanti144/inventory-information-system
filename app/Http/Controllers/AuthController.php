<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            // "name" column = the username shown on the profile page
            'name' => ['required', 'string', 'max:50', 'unique:users,name'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'name.unique' => 'This username is already taken.',
            'email.unique' => 'This email is already registered.',
        ]);

        // The "hashed" cast on User::password hashes it automatically.
        // role is NOT in $data, so every new account starts as "viewer" (DB default).
        User::create($data);

        return redirect(route('login') . '#login')
            ->with('status', 'Registration successful. Please login with your new account.');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials)) {
            return redirect(route('login') . '#login')
                ->withErrors(['email' => 'Email or password is incorrect.'])
                ->onlyInput('email');
        }

        // Correct password, but the account may have been switched off by an admin.
        if (! Auth::user()->is_active) {
            Auth::logout();

            return redirect(route('login') . '#login')
                ->withErrors(['email' => 'Your account has been deactivated. Please contact an administrator.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
