<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // TAMBAH INI

class Song extends Model
{
    use HasFactory, SoftDeletes; // TAMBAH SoftDeletes

    protected $fillable = ['artist_id', 'album_id', 'judul', 'durasi'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function getDurasiFormattedAttribute()
    {
        $minutes = floor($this->durasi / 60);
        $seconds = $this->durasi % 60;
        return sprintf('%d:%02d', $minutes, $seconds);
    }
}
