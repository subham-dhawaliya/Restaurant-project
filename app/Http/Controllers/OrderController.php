<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class OrderController extends Controller
{
    public function createRazorpayOrder(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'items' => 'required|array',
            'delivery_address' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required|string',
            'phone' => 'required|string',
        ]);
        
        try {
            $api = new Api(config('razorpay.key_id'), config('razorpay.key_secret'));
            
            $orderData = [
                'receipt' => 'order_' . time(),
                'amount' => $validated['amount'] * 100, // Amount in paise
                'currency' => 'INR',
                'notes' => [
                    'user_id' => Auth::id(),
                    'address' => $validated['delivery_address'],
                    'city' => $validated['city'],
                    'pincode' => $validated['pincode'],
                ]
            ];
            
            $razorpayOrder = $api->order->create($orderData);
            
            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'amount' => $razorpayOrder['amount'],
                'currency' => $razorpayOrder['currency'],
                'key' => config('razorpay.key_id'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating Razorpay order: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function verifyPayment(Request $request)
    {
        $validated = $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
            'order_data' => 'required|array',
        ]);
        
        try {
            $api = new Api(config('razorpay.key_id'), config('razorpay.key_secret'));
            
            // Verify signature
            $attributes = [
                'razorpay_order_id' => $validated['razorpay_order_id'],
                'razorpay_payment_id' => $validated['razorpay_payment_id'],
                'razorpay_signature' => $validated['razorpay_signature']
            ];
            
            $api->utility->verifyPaymentSignature($attributes);
            
            // Payment verified, create order
            $orderData = $validated['order_data'];
            
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'subtotal' => $orderData['subtotal'],
                'tax' => $orderData['tax'],
                'delivery_fee' => $orderData['delivery_fee'],
                'total' => $orderData['total'],
                'status' => 'pending',
                'payment_status' => 'paid',
                'payment_method' => 'razorpay',
                'delivery_address' => $orderData['delivery_address'] . ', ' . $orderData['city'] . ' - ' . $orderData['pincode'],
                'phone' => $orderData['phone'],
            ]);
            
            // Create order items
            foreach ($orderData['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $item['id'],
                    'item_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'customizations' => $item['customizations'] ?? null,
                ]);
            }
            
            // Save payment details
            Payment::create([
                'order_id' => $order->id,
                'payment_id' => $validated['razorpay_payment_id'],
                'payment_method' => 'razorpay',
                'amount' => $orderData['total'],
                'status' => 'success',
                'transaction_id' => $validated['razorpay_order_id'],
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Payment verified and order placed successfully!',
                'order_number' => $order->order_number,
                'order_id' => $order->id,
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 400);
        }
    }
    
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
