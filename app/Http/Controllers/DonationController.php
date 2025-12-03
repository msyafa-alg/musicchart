<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Album;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    public function store(Request $request, Artist $artist)
    {
        $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $amount = $request->amount;

        if ($user->points < $amount) {
            return back()->with('error', 'Poin tidak cukup untuk donasi.');
        }

        DB::transaction(function () use ($user, $artist, $amount) {
            // Kurangi poin user
            $user->decrement('points', $amount);

            // Tambah total donasi artis
            $artist->increment('total_donations', $amount);

            // Simpan record donasi
            Donation::create([
                'user_id' => $user->id,
                'artist_id' => $artist->id,
                'amount' => $amount,
            ]);
        });

        return back()->with('success', 'Donasi berhasil! Terima kasih atas dukungan Anda.');
    }

    public function topup(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer|min:1|max:10000',
        ]);

        $user = Auth::user();
        $amount = $request->amount;

        // Tambah poin ke user (simulasi top-up)
        $user->increment('points', $amount);

        return back()->with('success', "Top-up berhasil! {$amount} poin telah ditambahkan ke akun Anda.");
    }

    public function donateToAlbum(Request $request, Album $album)
    {
        $request->validate([
            'amount' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $amount = $request->amount;

        if ($user->points < $amount) {
            return back()->with('error', 'Poin tidak cukup untuk donasi.');
        }

        DB::transaction(function () use ($user, $album, $amount) {
            // Kurangi poin user
            $user->decrement('points', $amount);

            // Tambah total donasi album
            $album->increment('total_donations', $amount);

            // Simpan record donasi
            Donation::create([
                'user_id' => $user->id,
                'album_id' => $album->id,
                'amount' => $amount,
                'type' => 'album',
            ]);
        });

        return back()->with('success', 'Donasi ke album berhasil! Terima kasih atas dukungan Anda.');
    }
}
