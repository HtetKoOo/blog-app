<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function musicVideo()
    {
        return $this->belongsToMany(MusicVideo::class, 'music_video_singer');
    }
}
