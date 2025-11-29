<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Check if this is the first user
        $isFirstUser = User::count() === 0;

        // Try to login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Welcome back!');
        }

        // If login failed and this is first user, create admin account
        if ($isFirstUser) {
            $user = User::create([
                'name' => explode('@', $request->email)[0],
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => true,
            ]);

            Auth::login($user);
            $request->session()->regenerate();
            
            return redirect()->route('dashboard')->with('success', 'Admin account created successfully!');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $totalContacts = \App\Models\Contact::count();
        $recentContacts = \App\Models\Contact::orderBy('created_at', 'desc')->take(5)->get();
        
        return view('dashboard', compact('user', 'totalContacts', 'recentContacts'));
    }
}
