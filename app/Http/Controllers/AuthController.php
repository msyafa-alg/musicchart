<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
