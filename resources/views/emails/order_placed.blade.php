<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 30px;">
    <div style="max-width: 600px; margin: auto; background: #fff; padding: 25px; border-radius: 8px;">
        <h2 style="color: #333;">Hello {{ $order->first_name }},</h2>
        <p>Thank you for your order from <strong>Majira</strong>!</p>
        <p>Your payment has been received successfully. Below are your order details:</p>

        <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
        <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_amount, 2) }}</p>
        <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>

        <p>We’ll notify you once your order is shipped.</p>

        <p style="margin-top: 30px;">Thank you for shopping with us!</p>
        <p><strong>- The Majira Team</strong></p>
    </div>
</body>
</html>
