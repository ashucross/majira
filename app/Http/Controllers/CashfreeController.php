<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CashfreeController extends Controller
{ 

public function pay($order_id)
{
    $order = Order::findOrFail($order_id);

    $orderAmount = number_format((float)$order->total_amount, 2, '.', ''); // 2 decimals
    $appId = env('CASHFREE_APP_ID');
    $secretKey = env('CASHFREE_SECRET_KEY');
    $orderId = (string)$order->id;

    // Generate signature
    $signature = hash_hmac('sha256', $orderId . $orderAmount, $secretKey);

    $postData = [
        "appId" => $appId,
        "orderId" => $orderId,
        "orderAmount" => $orderAmount,
        "orderCurrency" => "INR",
        "customerName" => $order->first_name,
        "customerEmail" => $order->email,
        "customerPhone" => $order->phone,
        "returnUrl" => route('cashfree.callback'),
        "signature" => $signature,
    ];

    $url = env('CASHFREE_ENV') == 'LIVE'
        ? 'https://www.cashfree.com/checkout/post/submit'
        : 'https://test.cashfree.com/billpay/checkout/post/submit';

    return view('cashfree.pay', compact('postData', 'url'));
}


    public function callback(Request $request)
    {
        if(empy($request->orderId)){
            return redirect()->back()->with('error', 'Order id missing');
        }
        $order = Order::where('order_number', $request->orderId)->first();

        if($request->txStatus == 'SUCCESS'){
            $order->payment_status = 'paid';
        } else {
            $order->payment_status = 'failed';
        }

        $order->save();

        return redirect()->route('home')->with('success', 'Payment status updated: '.$request->txStatus);
    }
}
