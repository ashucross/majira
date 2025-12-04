<?php
namespace App\Http\Controllers;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart; 
use App\User;
use App\Mail\OrderPlacedMail;
use Illuminate\Support\Facades\Mail;
use Session;

class PaymentController extends Controller
{
    public function razorpayPay($order_id)
    {
        $order = Order::findOrFail($order_id);

        // Razorpay API keys from .env
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $razorpayOrder = $api->order->create([
            'receipt' => $order->order_number,
            'amount' => $order->total_amount * 100, // amount in paise
            'currency' => 'INR'
        ]);

        $order->razorpay_order_id = $razorpayOrder['id'];
        $order->save();

        return view('checkout', compact('order', 'razorpayOrder'));
    }

   public function razorpaySuccess(Request $request)
{
    $order = Order::where('razorpay_order_id', $request->razorpay_order_id)->first();

    if (!$order) {
        return redirect()->route('home')->with('error', 'Invalid Order!');
    }

    // Razorpay API keys
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    $attributes = [
        'razorpay_order_id' => $request->razorpay_order_id,
        'razorpay_payment_id' => $request->razorpay_payment_id,
        'razorpay_signature' => $request->razorpay_signature
    ];

    try {
        // Verify payment signature
        $api->utility->verifyPaymentSignature($attributes);

        // Mark order as paid
        $order->payment_status = 'paid';
        $order->save();

        // Clear cart & coupon
        Session::forget('cart');
        Session::forget('coupon');
        Cart::where('user_id', auth()->user()->id)->delete();

        // Send confirmation email to user and admin
        $user = User::find($order->user_id);
        if ($user && $user->email) {
            Mail::to($user->email)->send(new OrderPlacedMail($order));
        }

        // Send notification email to admin
        Mail::to('support@shopmajira.com')->send(new OrderPlacedMail($order));

        return redirect()->route('home')->with('success', 'Payment successful! Your order is confirmed. '.$order->order_number);

    } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
        // Payment failed verification
        return redirect()->route('home')->with('error', 'Payment verification failed. Please try again.');
    }
}

}
