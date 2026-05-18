<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class AdminAuthController extends Controller
{
    public function showRegister(): View
    {
        return view('admin.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'admin',
        ]);

        return redirect()
            ->route('teacher.login')
            ->with('success', 'Akun guru berhasil dibuat. Silakan login untuk masuk ke halaman guru.')
            ->withInput(['email' => $validated['email']]);
    }

    public function showLogin(): View
    {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ])) {
            $user = Auth::user();
            if (in_array($user->role, ['admin', 'superadmin'])) {
                $request->session()->regenerate();
                
                if ($user->role === 'superadmin') {
                    return redirect()->route('superadmin.dashboard');
                }
                
                return redirect()->route('teacher.dashboard');
            }
            
            Auth::logout();
        }

        return back()
            ->withErrors(['login' => 'Email atau password admin salah.'])
            ->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('teacher.login')->with('success', 'Berhasil logout.');
    }

    public function redirectToGoogle(): RedirectResponse
    {
        request()->session()->put('google_login_role', 'admin');

        return Socialite::driver('google')
            ->scopes(['profile', 'email'])
            ->redirectUrl(config('services.google.redirect'))
            ->redirect();
    }

    public function handleGoogleCallback(Request $request): RedirectResponse
    {
        $loginRole = $request->session()->pull('google_login_role', 'admin');

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('teacher.login')
                ->withErrors(['login' => 'Gagal login dengan Google. Silakan coba lagi.']);
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName() ?: $googleUser->getNickname() ?: 'Pengguna Google',
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(random_bytes(16)),
                'role' => $loginRole,
            ]);
        }

        if ($user->role !== $loginRole) {
            Auth::logout();

            return redirect()
                ->route($loginRole === 'student' ? 'student.login' : 'teacher.login')
                ->withErrors(['login' => $loginRole === 'student'
                    ? 'Email ini bukan akun siswa. Silakan gunakan akun siswa.'
                    : 'Email ini bukan akun guru. Silakan gunakan email guru.']);
        }

        Auth::login($user);
        $request->session()->regenerate();

        if ($loginRole === 'student') {
            return redirect()
                ->route('register.test')
                ->with('success', 'Login siswa dengan Google berhasil. Silakan isi data tes.');
        }

        if ($user->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        }

        return redirect()->route('teacher.dashboard');
    }
}
