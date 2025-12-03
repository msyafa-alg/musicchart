<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'bio',
        'photo',
        'total_donations'
    ];

    // Relationship dengan albums
    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    // Relationship dengan songs
    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    // Accessor untuk photo URL
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }
}
