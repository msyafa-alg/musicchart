<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArtistsExport;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::orderByRaw('CASE WHEN photo IS NOT NULL AND photo != "" THEN 1 ELSE 0 END DESC')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);


        $img = $request->file('photo');
        $nameImg =  Str::random(5). '-Artist.' . $img->getClientOriginalExtension();
        $path = $img->storeAs('artists', $nameImg, 'public');

        Artist::create([
            'name' => $request->name,
            'bio' => $request->bio,
            'photo' => $path,
        ]);

        return redirect()->route('artists.index')->with('success', 'Artist berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        return view('artists.show', compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        return view('artists.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $photoPath = $artist->photo;
        if ($request->hasFile('photo')) {
            if ($artist->photo && Storage::disk('public')->exists($artist->photo)) {
                Storage::disk('public')->delete($artist->photo);
            }

            $file = $request->file('photo');
            $filename = Str::random(5). '-Artist.' . $file->getClientOriginalExtension();
            $photoPath = $file->storeAs('artists', $filename, 'public');
        }

        $artist->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'photo' => $photoPath,
        ]);

        return redirect()->route('artists.index')->with('success', 'Artist berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        return redirect()->route('artists.index')->with('success', 'Artist berhasil dihapus!');
    }

    public function export()
    {
        return Excel::download(new ArtistsExport, 'artists-' . date('Y-m-d') . '.xlsx');
    }

    public function trash()
    {
        $artists = Artist::onlyTrashed()->latest()->get();
        return view('artists.trash', compact('artists'));
    }

    public function restore($id)
    {
        $artist = Artist::onlyTrashed()->findOrFail($id);
        $artist->restore();

        return redirect()->route('artists.trash')->with('success', 'Artist berhasil dipulihkan!');
    }

    public function forceDelete($id)
    {
        $artist = Artist::onlyTrashed()->findOrFail($id);

        if ($artist->photo && Storage::disk('public')->exists($artist->photo)) {
            Storage::disk('public')->delete($artist->photo);
        }

        $artist->forceDelete();

        return redirect()->route('artists.trash')->with('success', 'Artist berhasil dihapus permanen!');
    }
}
