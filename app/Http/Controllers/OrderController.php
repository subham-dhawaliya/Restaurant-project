<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.customizations' => 'nullable|string',
            'delivery_address' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|in:cod,online,upi',
            'subtotal' => 'required|numeric',
            'delivery_fee' => 'required|numeric',
            'tax' => 'required|numeric',
            'total' => 'required|numeric',
        ]);
        
        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'subtotal' => $validated['subtotal'],
            'tax' => $validated['tax'],
            'delivery_fee' => $validated['delivery_fee'],
            'total' => $validated['total'],
            'status' => 'pending',
            'payment_status' => $validated['payment_method'] === 'cod' ? 'pending' : 'pending',
            'payment_method' => $validated['payment_method'],
            'delivery_address' => $validated['delivery_address'] . ', ' . $validated['city'] . ' - ' . $validated['pincode'],
            'phone' => $validated['phone'],
        ]);
        
        // Create order items
        foreach ($validated['items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $item['id'],
                'item_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'customizations' => $item['customizations'] ?? null,
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully!',
            'order_number' => $order->order_number,
            'order_id' => $order->id,
        ]);
    }
    
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
                      ->with('orderItems')
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        return view('user.orders', compact('orders'));
    }
    
    public function orderDetails($id)
    {
        $order = Order::where('user_id', Auth::id())
                     ->with('orderItems')
                     ->findOrFail($id);
        
        return view('user.order-details', compact('order'));
    }
}
