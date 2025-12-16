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
    // Donasi ke artist
    public function store(Request $request, Artist $artist)
    {
        $request->validate([
            'amount' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $amount = $request->amount;

        // Cek poin user
        if ($user->points < $amount) {
            return back()->with('error', 'Poin tidak mencukupi!');
        }

        DB::transaction(function () use ($user, $artist, $amount) {
            // 1. Kurangi poin user
            $user->decrement('points', $amount);

            // 2. Hitung total donasi secara dinamis (tidak simpan di artist)
            // Simpan ke tabel donations saja

            // 3. Simpan record donasi
            Donation::create([
                'user_id' => $user->id,
                'artist_id' => $artist->id,
                'amount' => $amount,
            ]);
        });

        return back()->with('success', '🎉 Donasi berhasil! Terima kasih atas dukungan Anda.');
    }

    // Donasi ke album
    public function donateToAlbum(Request $request, Album $album)
    {
        $request->validate([
            'amount' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $amount = $request->amount;

        if ($user->points < $amount) {
            return back()->with('error', 'Poin tidak mencukupi!');
        }

        DB::transaction(function () use ($user, $album, $amount) {
            $user->decrement('points', $amount);

            Donation::create([
                'user_id' => $user->id,
                'album_id' => $album->id,
                'amount' => $amount,
            ]);
        });

        return back()->with('success', '🎵 Donasi ke album berhasil!');
    }

    // Top up poin
    public function topup(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer|min:100|max:1000000'
        ]);

        $user = Auth::user();
        $user->increment('points', $request->amount);

        return back()->with('success', '💰 Top up ' . number_format($request->amount) . ' poin berhasil!');
    }
}
