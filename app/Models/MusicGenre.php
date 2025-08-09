<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicGenre extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function musicVideos()
    {
        return $this->hasMany(MusicVideo::class, 'music_video_genre');
    }
}
