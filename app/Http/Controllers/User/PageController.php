<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $ads = Ads::latest()->take(5)->get();
        return view('user.home',compact('ads'));
    }
}
