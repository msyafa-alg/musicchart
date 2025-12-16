<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'artist_id',
        'album_id',
        'amount'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke artist
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    // Relasi ke album (opsional)
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
