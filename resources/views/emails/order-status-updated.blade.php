<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Status Update</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%); padding: 30px; text-align: center;">
                <h1 style="color: white; margin: 0; font-size: 28px;">Yummy Restaurant</h1>
                <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0; font-size: 14px;">Delicious Food, Delivered Fresh</p>
            </td>
        </tr>
        
        <!-- Status Icon -->
        <tr>
            <td style="padding: 40px 30px 20px; text-align: center;">
                @if($newStatus == 'delivered')
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                    <span style="font-size: 40px; color: white;">✓</span>
                </div>
                @elseif($newStatus == 'cancelled')
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #dc3545 0%, #ff6b6b 100%); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                    <span style="font-size: 40px; color: white;">✕</span>
                </div>
                @elseif($newStatus == 'out_for_delivery')
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                    <span style="font-size: 40px; color: white;">🚚</span>
                </div>
                @elseif($newStatus == 'preparing')
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #ffc107 0%, #ffca2c 100%); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                    <span style="font-size: 40px; color: white;">👨‍🍳</span>
                </div>
                @else
                <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                    <span style="font-size: 40px; color: white;">📋</span>
                </div>
                @endif
            </td>
        </tr>
        
        <!-- Main Content -->
        <tr>
            <td style="padding: 0 30px 30px; text-align: center;">
                <h2 style="color: #212529; margin: 0 0 10px; font-size: 24px;">
                    @if($newStatus == 'confirmed')
                        Order Confirmed! 🎉
                    @elseif($newStatus == 'preparing')
                        Your Food is Being Prepared! 👨‍🍳
                    @elseif($newStatus == 'out_for_delivery')
                        Out for Delivery! 🚚
                    @elseif($newStatus == 'delivered')
                        Order Delivered! ✅
                    @elseif($newStatus == 'cancelled')
                        Order Cancelled 😔
                    @else
                        Order Status Updated
                    @endif
                </h2>
                <p style="color: #6c757d; margin: 0; font-size: 16px;">
                    @if($newStatus == 'confirmed')
                        Great news! Your order has been confirmed and will be prepared soon.
                    @elseif($newStatus == 'preparing')
                        Our chefs are now preparing your delicious food with love!
                    @elseif($newStatus == 'out_for_delivery')
                        Your order is on its way! Our delivery partner will reach you soon.
                    @elseif($newStatus == 'delivered')
                        Your order has been delivered. Enjoy your meal!
                    @elseif($newStatus == 'cancelled')
                        We're sorry, your order has been cancelled. If you have any questions, please contact us.
                    @else
                        Your order status has been updated.
                    @endif
                </p>
            </td>
        </tr>
        
        <!-- Order Details Box -->
        <tr>
            <td style="padding: 0 30px 30px;">
                <table width="100%" cellpadding="0" cellspacing="0" style="background: #f8f9fa; border-radius: 12px; overflow: hidden;">
                    <tr>
                        <td style="background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%); padding: 15px 20px; text-align: center;">
                            <p style="color: rgba(255,255,255,0.9); margin: 0; font-size: 12px;">ORDER NUMBER</p>
                            <p style="color: white; margin: 5px 0 0; font-size: 20px; font-weight: bold; letter-spacing: 2px;">{{ $order->order_number }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                                        <span style="color: #6c757d;">Status</span>
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e9ecef; text-align: right;">
                                        <span style="background: {{ $newStatus == 'delivered' ? '#28a745' : ($newStatus == 'cancelled' ? '#dc3545' : '#ffc107') }}; color: {{ $newStatus == 'preparing' ? '#212529' : 'white' }}; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase;">
                                            {{ str_replace('_', ' ', $newStatus) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                                        <span style="color: #6c757d;">Payment Method</span>
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e9ecef; text-align: right;">
                                        <span style="color: #212529; font-weight: 600;">{{ ucfirst($order->payment_method) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e9ecef;">
                                        <span style="color: #6c757d;">Delivery Address</span>
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e9ecef; text-align: right;">
                                        <span style="color: #212529;">{{ $order->delivery_address }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0;">
                                        <span style="color: #6c757d; font-weight: 600;">Total Amount</span>
                                    </td>
                                    <td style="padding: 10px 0; text-align: right;">
                                        <span style="color: #ce1212; font-size: 20px; font-weight: bold;">₹{{ number_format($order->total, 2) }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <!-- Order Items -->
        <tr>
            <td style="padding: 0 30px 30px;">
                <h3 style="color: #212529; margin: 0 0 15px; font-size: 18px;">Order Items</h3>
                <table width="100%" cellpadding="0" cellspacing="0" style="background: #f8f9fa; border-radius: 12px;">
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td style="padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                            <span style="color: #212529; font-weight: 600;">{{ $item->item_name }}</span>
                            <span style="color: #6c757d;"> x {{ $item->quantity }}</span>
                        </td>
                        <td style="padding: 15px 20px; border-bottom: 1px solid #e9ecef; text-align: right;">
                            <span style="color: #ce1212; font-weight: 600;">₹{{ number_format($item->price * $item->quantity, 2) }}</span>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
        
        <!-- CTA Button -->
        <tr>
            <td style="padding: 0 30px 40px; text-align: center;">
                <a href="{{ url('/my-orders') }}" style="display: inline-block; background: linear-gradient(135deg, #ce1212 0%, #ff4444 100%); color: white; text-decoration: none; padding: 15px 40px; border-radius: 10px; font-weight: 600; font-size: 16px;">
                    View Order Details
                </a>
            </td>
        </tr>
        
        <!-- Footer -->
        <tr>
            <td style="background: #212529; padding: 30px; text-align: center;">
                <p style="color: rgba(255,255,255,0.9); margin: 0 0 10px; font-size: 16px; font-weight: 600;">Yummy Restaurant</p>
                <p style="color: rgba(255,255,255,0.6); margin: 0 0 15px; font-size: 14px;">Thank you for ordering with us!</p>
                <p style="color: rgba(255,255,255,0.5); margin: 0; font-size: 12px;">
                    If you have any questions, please contact us at<br>
                    <a href="mailto:support@yummy.com" style="color: #ce1212;">support@yummy.com</a>
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
