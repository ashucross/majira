<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .payment-container {
            background: #fff;
            padding: 40px 50px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 400px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 1.5rem;
        }
        #rzp-button {
            background-color: #528FF0;
            border: none;
            color: #fff;
            padding: 14px 30px;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        #rzp-button:hover {
            background-color: #3b72d0;
            box-shadow: 0 4px 10px rgba(82, 143, 240, 0.3);
        }
        p {
            color: #555;
            margin-top: 10px;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

    <div class="payment-container">
        <h2>Pay for Order #{{ $order->order_number }}</h2>
        <p>Total Amount: <strong>₹{{ number_format($order->total_amount, 2) }}</strong></p>
        <button id="rzp-button">Pay Now</button>

        <form action="{{ route('razorpay.success') }}" method="POST" id="razorpay-form" style="display:none;">
            @csrf
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="{{ $razorpayOrder['id'] }}">
            <input type="hidden" name="razorpay_signature" id="razorpay_signature">
        </form>
    </div>

    <script>
        var options = {
            key: "{{ env('RAZORPAY_KEY') }}",
            amount: "{{ $order->total_amount * 100 }}", // Amount in paise
            currency: "INR",
            name: "Shop From Majira",
            description: "Order #{{ $order->order_number }}",
            order_id: "{{ $razorpayOrder['id'] }}",
            handler: function (response){
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('razorpay-form').submit();
            },
            theme: {
                color: "#528FF0"
            }
        };

        var rzp = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function(e){
            rzp.open();
            e.preventDefault();
        };
    </script>

</body>
</html>
