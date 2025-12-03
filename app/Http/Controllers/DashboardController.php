<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Album;

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
                'total_users' => \App\Models\User::count(),
                'total_songs' => \App\Models\Song::count() ?? 0,
                'total_artists' => \App\Models\Artist::count() ?? 0,
                'total_albums' => \App\Models\Album::count() ?? 0,
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
            // Get top albums by popularity (same as welcome page)
            $topAlbums = Album::with('artist')
                ->withCount('songs')
                ->whereHas('artist')
                ->orderBy('popularity', 'desc')
                ->orderBy('created_at', 'desc')
                ->limit(12)
                ->get();

            // Get stats for the counter (same as welcome page)
            $totalSongs = \App\Models\Song::count();
            $totalArtists = \App\Models\Artist::count();

            $topArtists = \App\Models\Artist::orderByRaw('CASE WHEN photo IS NOT NULL AND photo != "" THEN 1 ELSE 0 END DESC')
                ->orderBy('total_donations', 'desc')
                ->orderBy('created_at', 'desc')
                ->limit(12)
                ->get();
        } catch (\Throwable $e) {
            // Log the error and fall back to safe defaults
            Log::error('User dashboard DB error: ' . $e->getMessage());
            $topAlbums = collect();
            $totalSongs = 0;
            $totalArtists = 0;
            $topArtists = collect();
        }

        return view('user.dashboard', [
            'user' => $user,
            'topAlbums' => $topAlbums,
            'totalSongs' => $totalSongs,
            'totalArtists' => $totalArtists,
            'topArtists' => $topArtists,
        ]);
    }
}
