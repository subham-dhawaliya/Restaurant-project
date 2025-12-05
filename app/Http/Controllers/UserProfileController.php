<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::guard('web')->user();
        return view('user.profile', compact('user'));
    }
    
    public function update(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:10',
        ]);
        
        $user->update($validated);
        
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
    
    public function updatePassword(Request $request)
    {
        $user = Auth::guard('web')->user();
        
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        
        // Check if current password is correct
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }
        
        // Update password
        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);
        
        return redirect()->route('user.profile')->with('success', 'Password updated successfully!');
    }
}
