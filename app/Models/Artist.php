<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasFactory, SoftDeletes;

    // HAPUS 'total_donations' dari fillable karena kita hitung dinamis
    protected $fillable = [
        'name',
        'bio',
        'photo',
        // 'total_donations' // HAPUS BARIS INI
    ];

    // Relationship dengan albums
    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    // Relationship dengan songs melalui album
    public function songs()
    {
        return $this->hasManyThrough(
            Song::class,
            Album::class,
            'artist_id', // Foreign key on albums table
            'album_id',  // Foreign key on songs table
            'id',        // Local key on artists table
            'id'         // Local key on albums table
        );
    }

    // Relationship dengan donations
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // Accessor untuk photo URL
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }

    // Accessor untuk total donations (dinamis dari tabel donations)
    public function getTotalDonationsAttribute()
    {
        return $this->donations()->sum('amount');
    }

    // Method untuk eager load total donations dengan performa lebih baik
    public function scopeWithTotalDonations($query)
    {
        return $query->withSum('donations', 'amount')
                     ->selectRaw('artists.*, COALESCE(SUM(donations.amount), 0) as total_donations_sum');
    }

    // Boot method untuk menghandle soft delete cascade
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($artist) {
            if ($artist->isForceDeleting()) {
                // Force delete semua relasi
                $artist->albums()->withTrashed()->forceDelete();
                $artist->donations()->forceDelete();
            } else {
                // Soft delete relasi
                $artist->albums()->delete();
            }
        });

        static::restoring(function ($artist) {
            $artist->albums()->withTrashed()->restore();
        });
    }
}
