<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4',
        ]);
        $checkEmail = User::where('email', $request->email)->first();
        if (!$checkEmail) {
            return redirect()->back()->with('error', 'Email not found');
        }
        $checkPassword = Hash::check($request->password, $checkEmail->password);
        if (!$checkPassword) {
            return redirect()->back()->with('error', 'Incorrect password');
        }
        auth()->login($checkEmail);
        return redirect('/')->with('success', 'Login successful');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4',
        ]);
        $checkEmail = User::where('email', $request->email)->first();
        if ($checkEmail) {
            return redirect()->back()->with('error', 'Email already exists');
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        auth()->login($user);
        return redirect('/')->with('success', 'Welcome' . auth()->user()->name . ', Registration successful');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login')->with('success', 'Logout successful');
    }
}
