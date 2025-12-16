<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        // Validasi sederhana
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar dalam sistem.',
            ])->withInput()->with('error_type', 'unregistered_email');
        }

        // Coba login dengan Auth::attempt (cara standard Laravel)
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $request->session()->regenerate();

                // Redirect berdasarkan role
                if (Auth::user()->isAdmin()) {
                    return redirect()->route('admin.dashboard');
                }

                return redirect()->route('user.dashboard');
            }
        } catch (\Throwable $e) {
            // Logging untuk debugging, tampilkan pesan yang ramah user
            Log::error('Login DB error: ' . $e->getMessage());
            return back()->withErrors([
                'email' => 'Server tidak dapat dihubungi saat ini. Silakan coba lagi nanti atau hubungi admin.',
            ])->withInput()->with('error_type', 'server_error');
        }

        // Kalo gagal (kredensial salah)
        return back()->withErrors([
            'email' => 'Password yang Anda masukkan salah.',
        ])->withInput()->with('error_type', 'wrong_password');
    }

    /**
     * Handle user registration
     */
    public function register(Request $request)
{
    try {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'accepted'
        ], [
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'username.unique' => 'Username sudah digunakan. Silakan pilih username lain.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.'
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal. Periksa kembali data Anda.');
        }

        // Create new user - PASTIKAN username disertakan
        $user = User::create([
            'name' => $request->username,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'points' => 1000,
        ]);

        // Auto login setelah registrasi
        Auth::login($user);

        // Redirect ke dashboard user
        return redirect()->route('user.dashboard')
            ->with('success', '🎉 Registrasi berhasil! Selamat datang di MusicChart. Anda mendapatkan 1000 poin awal!');

    } catch (\Throwable $e) {
        // Log error
        Log::error('Registration error: ' . $e->getMessage());

        return redirect()->back()
            ->withErrors([
                'email' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ])
            ->withInput()
            ->with('error_type', 'server_error');
    }
}

    /**
     * Handle user logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Check if user is admin (helper method)
     */
    private function isAdmin(User $user)
    {
        return $user->is_admin == 1 || $user->is_admin == true;
    }
}
