<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Artist;

class MusicChartController extends Controller
{
    public function index()
    {
        $songs = Song::with(['artist', 'album'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('music-chart', compact('songs'));
    }

    public function artistDetail($id)
    {
        $artist = Artist::with(['albums', 'songs'])->findOrFail($id);
        return view('artist-detail', compact('artist'));
    }
}
