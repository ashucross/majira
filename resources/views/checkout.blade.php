<!DOCTYPE html>
<html>
<head>
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <h2>Pay for Order: {{ $order->order_number }}</h2>
    <button id="rzp-button">Pay ₹{{ number_format($order->total_amount, 2) }}</button>

    <form action="{{ route('razorpay.success') }}" method="POST" id="razorpay-form">
        @csrf
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="{{ $razorpayOrder['id'] }}">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    </form>

    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": "{{ $order->total_amount * 100 }}", // in paise
            "currency": "INR",
            "name": "Your Company Name",
            "description": "Order #{{ $order->order_number }}",
            "order_id": "{{ $razorpayOrder['id'] }}",
            "handler": function (response){
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('razorpay-form').submit();
            },
            "theme": {
                "color": "#528FF0"
            }
        };
        var rzp = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function(e){
            rzp.open();
            e.preventDefault();
        }
    </script>
</body>
</html>
