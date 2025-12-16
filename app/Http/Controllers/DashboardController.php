<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Album;
use App\Models\Song;
use App\Models\Artist;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        // Cek apakah user adalah admin
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('login')->withErrors(['email' => 'Unauthorized access.']);
        }

        return view('admin.dashboard', [
            'user' => Auth::user(),
            'stats' => [
                'total_users' => User::count(),
                'total_songs' => Song::count(),
                'total_artists' => Artist::count(),
                'total_albums' => Album::count(),
            ]
        ]);
    }

    public function userDashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        try {
            // QUERY TOP ALBUMS - SAMA DENGAN HOME PAGE
            $topAlbums = Album::with(['artist' => function($query) {
                    $query->select('id', 'name', 'photo'); // Ambil hanya field yang diperlukan
                }])
                ->withCount('songs')
                ->where('popularity', '>', 0) // Album dengan popularity > 0
                ->orderBy('popularity', 'desc')
                ->orderBy('created_at', 'desc')
                ->limit(12)
                ->get(['id', 'judul', 'artist_id', 'cover', 'popularity', 'tanggal_rilis', 'created_at']);

            // Get stats
            $totalSongs = Song::count();
            $totalArtists = Artist::count();

            // Get top artists dengan total donations
            $topArtists = Artist::withSum('donations', 'amount')
                ->orderBy('donations_sum_amount', 'desc')
                ->orderBy('created_at', 'desc')
                ->limit(8)
                ->get(['id', 'name', 'photo', 'created_at']);

            // Jika tidak ada albums dengan popularity > 0, ambil semua
            if ($topAlbums->count() == 0) {
                $topAlbums = Album::with(['artist' => function($query) {
                        $query->select('id', 'name', 'photo');
                    }])
                    ->withCount('songs')
                    ->orderBy('created_at', 'desc')
                    ->limit(12)
                    ->get(['id', 'judul', 'artist_id', 'cover', 'popularity', 'tanggal_rilis', 'created_at']);
            }

            // Log untuk debugging
            if ($topAlbums->count() == 0) {
                Log::warning('User Dashboard - No albums found in database');
            }

        } catch (\Throwable $e) {
            Log::error('User dashboard DB error: ' . $e->getMessage());
            Log::error('Error trace: ' . $e->getTraceAsString());

            // Fallback dengan data minimal
            $topAlbums = collect();
            $totalSongs = 0;
            $totalArtists = 0;
            $topArtists = collect();
        }

        // Pastikan view name benar - cek file di resources/views/user/dashboard.blade.php
        return view('user.dashboard', compact(
            'user',
            'topAlbums',
            'totalSongs',
            'totalArtists',
            'topArtists'
        ));
    }
}
