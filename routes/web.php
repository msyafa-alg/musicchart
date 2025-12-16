<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\DonationController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArtistsExport;
use App\Exports\ArtistsPdfExport;
use App\Exports\AlbumsExport;
use App\Exports\AlbumsPdfExport;
use App\Exports\SongsExport;
use App\Exports\SongsPdfExport;
use App\Models\Album;
use App\Models\Song;
use App\Models\Artist;
use Illuminate\Support\Facades\Log;

// ==================== PUBLIC ROUTES ====================
Route::get('/', function () {
    try {
        // Get top albums by popularity
        $topAlbums = Album::with('artist')
            ->withCount('songs')
            ->whereHas('artist')
            ->orderBy('popularity', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(12)
            ->get();

        // Get stats for the counter
        $totalSongs = Song::count();
        $totalArtists = Artist::count();
    } catch (\Throwable $e) {
        // Log the error and fall back to safe defaults so the public page doesn't crash
        Log::error('Home route DB error: ' . $e->getMessage());
        $topAlbums = collect();
        $totalSongs = 0;
        $totalArtists = 0;
    }

    return view('welcome', compact('topAlbums', 'totalSongs', 'totalArtists'));
})->name('home');

// ==================== AUTH ROUTES ====================
Route::get('/login', function() {
    return view('auth.login');
})->name('login');

Route::get('/register', function() {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Route POST login tetap sama
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== ADMIN ROUTES ====================
Route::middleware(['admin'])->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');

     // USER MANAGEMENT - TOPUP POINTS (BARU)
    Route::get('/admin/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}/edit-points', [\App\Http\Controllers\Admin\UserController::class, 'editPoints'])->name('admin.users.edit-points');
    Route::post('/admin/users/{user}/update-points', [\App\Http\Controllers\Admin\UserController::class, 'updatePoints'])->name('admin.users.update-points');
    Route::post('/admin/users/{user}/topup', [\App\Http\Controllers\Admin\UserController::class, 'topup'])->name('admin.users.topup');

    // ========== ARTISTS ROUTES ==========
    // Artists Export
    Route::get('/artists/export', function () {
        return Excel::download(new ArtistsExport, 'artists-' . date('Y-m-d') . '.xlsx');
    })->name('artists.export');

    // Artists Trash Management
    Route::get('/artists/trash', [ArtistController::class, 'trash'])->name('artists.trash');
    Route::post('/artists/{id}/restore', [ArtistController::class, 'restore'])->name('artists.restore');
    Route::delete('/artists/{id}/force-delete', [ArtistController::class, 'forceDelete'])->name('artists.forceDelete');

    Route::resource('artists', ArtistController::class);

    // ========== ALBUMS ROUTES ==========
    // Albums Export
    Route::get('/albums/export', function () {
        return Excel::download(new AlbumsExport, 'albums-' . date('Y-m-d') . '.xlsx');
    })->name('albums.export');

    // Albums PDF Export
    Route::get('/albums/export-pdf', function () {
        return (new AlbumsPdfExport)->export();
    })->name('albums.export-pdf');

    // Albums Trash Management
    Route::get('/albums/trash', [AlbumController::class, 'trash'])->name('albums.trash');
    Route::post('/albums/{id}/restore', [AlbumController::class, 'restore'])->name('albums.restore');
    Route::delete('/albums/{id}/force-delete', [AlbumController::class, 'forceDelete'])->name('albums.forceDelete');

    Route::resource('albums', AlbumController::class);

    // ========== SONGS ROUTES ==========
    // Songs Export
    Route::get('/songs/export', [SongController::class, 'export'])->name('songs.export');

    // Songs Trash Management
    Route::get('/songs/trash', [SongController::class, 'trash'])->name('songs.trash');
    Route::post('/songs/{id}/restore', [SongController::class, 'restore'])->name('songs.restore');
    Route::delete('/songs/{id}/force-delete', [SongController::class, 'forceDelete'])->name('songs.forceDelete');

    Route::resource('songs', SongController::class);

});


// User dashboard (requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [App\Http\Controllers\DashboardController::class, 'userDashboard'])->name('user.dashboard');

    // Donation routes
    Route::post('/artists/{artist}/donate', [DonationController::class, 'store'])->name('donations.store');
    Route::post('/albums/{album}/donate', [DonationController::class, 'donateToAlbum'])->name('albums.donate');
    Route::post('/topup', [DonationController::class, 'topup'])->name('topup');
});

// ==================== COMMENTED ROUTES ====================
// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->name('password.request');
//
// Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
//
// Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
