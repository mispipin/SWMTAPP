<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class StudentAuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->role === 'student') {
            return redirect()->route('register.test');
        }

        return view('student.login');
    }

    public function showRegister(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->role === 'student') {
            return redirect()->route('register.test');
        }

        return view('student.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'student',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('register.test')
            ->with('success', 'Akun siswa berhasil dibuat. Silakan isi data tes.');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'student',
        ], $request->boolean('remember'))) {
            return back()->withErrors([
                'login' => 'Email atau password siswa tidak valid.',
            ])->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        return redirect()
            ->route('register.test')
            ->with('success', 'Login siswa berhasil. Silakan isi data tes.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student.login');
    }

    public function redirectToGoogle(): RedirectResponse
    {
        $request = request();
        $request->session()->put('google_login_role', 'student');

        return Socialite::driver('google')
            ->scopes(['profile', 'email'])
            ->redirectUrl(config('services.google.redirect'))
            ->redirect();
    }
}