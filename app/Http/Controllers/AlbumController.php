<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    /**
 * Display a listing of the resource.
 */
public function index()
{
    // Pastikan query ini mengembalikan data
    $albums = Album::with('artist')->latest()->get();

    // Debug sementara - hapus nanti
    logger('Albums count: ' . $albums->count());
    foreach($albums as $album) {
        logger('Album: ' . $album->judul . ' - Artist: ' . optional($album->artist)->name);
    }

    return view('albums.index', compact('albums'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artists = Artist::all();
        return view('albums.create', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'artist_id' => 'required|exists:artists,id',
        'judul' => 'required|string|max:255',
        'tanggal_rilis' => 'nullable|date',
        'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'popularity' => 'nullable|integer|min:0|max:100'
    ]);

    $coverImg = $request->file('cover');
    $imgName =  'Cover-' . Str::random(5). '.' . $coverImg->getClientOriginalExtension();
    $coverPath = $coverImg->storeAs('albums', $imgName, 'public');

    // Simpan data
    Album::create([
        'artist_id' => $request->artist_id,
        'judul' => $request->judul,
        'tanggal_rilis' => $request->tanggal_rilis,
        'cover' => $coverPath,
        'popularity' => $request->popularity ?? 0,
    ]);

    // Redirect ke index dengan data fresh
    return redirect()->route('albums.index')->with('success', 'Album berhasil ditambahkan!');
}
    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        $album->load('artist');
        return view('albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        $artists = Artist::all();
        return view('albums.edit', compact('album', 'artists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $request->validate([
            'artist_id' => 'required|exists:artists,id',
            'judul' => 'required|string|max:255',
            'tanggal_rilis' => 'nullable|date',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'popularity' => 'nullable|integer|min:0|max:100'
        ]);

        $coverPath = $album->cover;
        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($album->cover) {
                Storage::disk('public')->delete($album->cover);
            }
            $coverPath = $request->file('cover')->store('albums', 'public');
        }

        $album->update([
            'artist_id' => $request->artist_id,
            'judul' => $request->judul,
            'tanggal_rilis' => $request->tanggal_rilis,
            'cover' => $coverPath,
            'popularity' => $request->popularity ?? $album->popularity,
        ]);

        return redirect()->route('albums.index')->with('success', 'Album berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('albums.index')->with('success', 'Album berhasil dihapus!');
    }

    /**
     * Display a listing of trashed albums.
     */
    public function trash()
    {
        $albums = Album::onlyTrashed()->with('artist')->latest()->get();
        return view('albums.trash', compact('albums'));
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore($id)
    {
        $album = Album::onlyTrashed()->findOrFail($id);
        $album->restore();
        return redirect()->route('albums.trash')->with('success', 'Album berhasil dipulihkan!');
    }

    /**
     * Permanently delete the specified resource from storage.
     */
    public function forceDelete($id)
    {
        $album = Album::onlyTrashed()->findOrFail($id);

        if ($album->cover) {
            Storage::disk('public')->delete($album->cover);
        }

        $album->forceDelete();
        return redirect()->route('albums.trash')->with('success', 'Album berhasil dihapus permanen!');
    }
}
