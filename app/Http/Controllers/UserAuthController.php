<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function showRegister()
    {
        // If admin is already logged in, redirect to dashboard
        if (Auth::check() && (Auth::user()->role === 'admin' || (isset(Auth::user()->is_admin) && Auth::user()->is_admin))) {
            return redirect()->route('dashboard');
        }
        return view('user.register');
    }
    
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'customer',
        ]);
        
        Auth::login($user);
        
        return redirect()->route('checkout')->with('success', 'Registration successful! Please complete your order.');
    }
    
    public function showLogin()
    {
        // If admin is already logged in, redirect to dashboard
        if (Auth::check() && (Auth::user()->role === 'admin' || (isset(Auth::user()->is_admin) && Auth::user()->is_admin))) {
            return redirect()->route('dashboard');
        }
        return view('user.login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Check if user is admin - prevent admin from using customer login
            if (Auth::user()->role === 'admin' || (isset(Auth::user()->is_admin) && Auth::user()->is_admin)) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'This is an admin account. Please use the admin login at /login',
                ])->withInput($request->only('email'));
            }
            
            // Redirect customer to checkout if they have items in cart
            return redirect()->route('checkout')->with('success', 'Login successful!');
        }
        
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput($request->only('email'));
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }
}
