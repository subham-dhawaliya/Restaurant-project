<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    private function checkAdmin()
    {
        if (!auth()->guard('admin')->check() || (auth()->guard('admin')->user()->role !== 'admin' && !auth()->guard('admin')->user()->is_admin)) {
            auth()->guard('admin')->logout();
            abort(redirect()->route('login')->with('error', 'Access denied. Admin login required.'));
        }
    }
    
    public function index()
    {
        $this->checkAdmin();
        
        $users = User::where('role', 'customer')
                    ->withCount('orders')
                    ->orderBy('created_at', 'desc')
                    ->paginate(20);
        
        $stats = [
            'total_customers' => User::where('role', 'customer')->count(),
            'new_today' => User::where('role', 'customer')->whereDate('created_at', today())->count(),
            'active_customers' => User::where('role', 'customer')->has('orders')->count(),
        ];
        
        return view('admin.users.index', compact('users', 'stats'));
    }
    
    public function show($id)
    {
        $this->checkAdmin();
        
        $user = User::with(['orders' => function($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($id);
        
        return view('admin.users.show', compact('user'));
    }
}
