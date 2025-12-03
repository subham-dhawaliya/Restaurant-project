<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    private function checkAdmin()
    {
        if (!auth()->check() || (auth()->user()->role !== 'admin' && !auth()->user()->is_admin)) {
            auth()->logout();
            abort(redirect()->route('login')->with('error', 'Access denied. Admin login required.'));
        }
    }
    
    public function index()
    {
        $this->checkAdmin();
        
        $orders = Order::with(['user', 'orderItems'])->orderBy('created_at', 'desc')->paginate(20);
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'completed_orders' => Order::where('status', 'delivered')->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
        ];
        
        return view('admin.orders.index', compact('orders', 'stats'));
    }
    
    public function show($id)
    {
        $this->checkAdmin();
        
        $order = Order::with(['user', 'orderItems.menuItem'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $this->checkAdmin();
        
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        
        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
}
