<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MusicVideo;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MusicController extends Controller
{
    public function all()
    {
        $music = MusicVideo::with('singer', 'genre')->get();
        return view('user.music.all', compact('music'));
    }
}
