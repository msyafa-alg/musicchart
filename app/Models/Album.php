<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Album extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['artist_id', 'judul', 'tanggal_rilis', 'cover', 'popularity', 'total_donations'];

    // Accessor untuk cover URL
    public function getCoverUrlAttribute()
    {
        if ($this->cover) {
            return Storage::disk('public')->url($this->cover);
        }
        return null;
    }

    // Accessor untuk cek cover exists
    public function getCoverExistsAttribute()
    {
        return $this->cover && Storage::disk('public')->exists($this->cover);
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'album_user')->withTimestamps();
    }
}
