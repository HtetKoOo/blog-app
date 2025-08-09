<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicVideo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function singer()
    {
        return $this->belongsToMany(Singer::class, 'music_video_singer');
    }

    public function genre()
    {
        return $this->belongsToMany(MusicGenre::class, 'music_video_genre');
    }
}
