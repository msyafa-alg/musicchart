<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Artist;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel; // TAMBAH INI
use App\Exports\SongsExport; // TAMBAH INI

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $songs = Song::with(['artist', 'album'])->latest()->get();
        return view('songs.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artists = Artist::all();
        $albums = Album::all();
        return view('songs.create', compact('artists', 'albums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'required|exists:albums,id',
            'judul' => 'required|string|max:255',
            'durasi' => 'required|integer|min:1', // dalam detik
        ]);

        Song::create([
            'artist_id' => $request->artist_id,
            'album_id' => $request->album_id,
            'judul' => $request->judul,
            'durasi' => $request->durasi,
        ]);

        return redirect()->route('songs.index')->with('success', 'Song berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        $song->load(['artist', 'album']);
        return view('songs.show', compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        $artists = Artist::all();
        $albums = Album::all();
        return view('songs.edit', compact('song', 'artists', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $song)
    {
        $request->validate([
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'required|exists:albums,id',
            'judul' => 'required|string|max:255',
            'durasi' => 'required|integer|min:1',
        ]);

        $song->update([
            'artist_id' => $request->artist_id,
            'album_id' => $request->album_id,
            'judul' => $request->judul,
            'durasi' => $request->durasi,
        ]);

        return redirect()->route('songs.index')->with('success', 'Song berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        $song->delete();
        return redirect()->route('songs.index')->with('success', 'Song berhasil dihapus!');
    }

    /**
     * Export songs to Excel
     */
    public function export()
    {
        return Excel::download(new SongsExport, 'songs-' . date('Y-m-d') . '.xlsx');
    }

/**
 * Display a listing of trashed songs.
 */
public function trash()
{
    $songs = Song::onlyTrashed()->with(['artist', 'album'])->latest()->get();
    return view('songs.trash', compact('songs'));
}

/**
 * Restore the specified resource from trash.
 */
public function restore($id)
{
    $song = Song::onlyTrashed()->findOrFail($id);
    $song->restore();

    return redirect()->route('songs.trash')->with('success', 'Song berhasil dipulihkan!');
}

/**
 * Permanently delete the specified resource from storage.
 */
public function forceDelete($id)
{
    $song = Song::onlyTrashed()->findOrFail($id);
    $song->forceDelete();

    return redirect()->route('songs.trash')->with('success', 'Song berhasil dihapus permanen!');
}
}
