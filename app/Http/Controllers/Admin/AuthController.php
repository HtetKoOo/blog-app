<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.admin_login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $checkAuth = Auth::guard('admin')->attempt($credentials);
        if(!$checkAuth){
            return redirect()->back()->with('error', 'Invalid credentials');
        }
        return redirect('/admin/')->with('success', 'Login successful');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login')->with('success', 'Logout successful');
    }
}
