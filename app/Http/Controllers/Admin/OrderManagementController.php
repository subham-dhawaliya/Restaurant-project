<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusUpdated;

class OrderManagementController extends Controller
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
        
        $order = Order::with(['user', 'orderItems'])->findOrFail($id);
        $oldStatus = $order->status;
        $newStatus = $request->status;
        
        // Update order status
        $order->status = $newStatus;
        $order->save();
        
        $emailSent = false;
        $emailError = null;
        
        // Send email notification to user if status changed
        if ($oldStatus !== $newStatus && $order->user && $order->user->email) {
            try {
                Mail::to($order->user->email)->send(new OrderStatusUpdated($order, $oldStatus, $newStatus));
                $emailSent = true;
            } catch (\Exception $e) {
                // Log error but don't fail the request
                \Log::error('Failed to send order status email: ' . $e->getMessage());
                $emailError = $e->getMessage();
            }
        }
        
        // Build success message based on email status
        $statusLabel = ucfirst(str_replace('_', ' ', $newStatus));
        
        if ($emailSent) {
            $message = "Order status updated to '{$statusLabel}'! ✅ Email notification sent to {$order->user->email}";
        } elseif ($emailError) {
            $message = "Order status updated to '{$statusLabel}'! ⚠️ Email failed to send: {$emailError}";
        } elseif (!$order->user || !$order->user->email) {
            $message = "Order status updated to '{$statusLabel}'! ⚠️ No customer email found.";
        } else {
            $message = "Order status updated to '{$statusLabel}'!";
        }
        
        return redirect()->back()->with('success', $message);
    }
}
