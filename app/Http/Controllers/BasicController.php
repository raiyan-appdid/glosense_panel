<?php

namespace App\Http\Controllers;

use App\Mail\Invoice;
use App\Models\CcAvenueTransaction;
use App\Models\Order;
use App\Services\ccavenue\helpers\CCCrypto;
use App\Services\ShipRocket\CreateOrderService;
use App\Services\ShipRocket\GenerateTokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class BasicController extends Controller
{
    public function successCallBack(Request $request)
    {
        $ccCrypto = new CCCrypto();
        $avenue_payment = $ccCrypto->decrypt($request->encResp);

        $updateTransaction = CcAvenueTransaction::where('transaction_order_id', $avenue_payment['order_id'])->with(['order'])->first();
        $updateTransaction->tracking_id = $avenue_payment['tracking_id'];
        $updateTransaction->status = $avenue_payment['order_status'];
        $updateTransaction->payment_response_json = $avenue_payment;
        $updateTransaction->save();
        \Log::info($avenue_payment);

        $token = new GenerateTokenService;
        $token = $token->getToken();



        $updateOrder = Order::where('id', $updateTransaction->order->id)->first();

        $shiprocketOrder = new CreateOrderService;
        $response = $shiprocketOrder->create($token, $updateOrder);
        \Log::info($response);

        // $updateOrder->status = $response['status'];
        // $updateOrder->shipment_id = $response['shipment_id'];
        // $updateOrder->save();
        Mail::to($updateOrder->email)->send(new Invoice($updateTransaction->order->id));

        $url = "https://glosense.in/order-placed";
        return redirect()->away($url);
        // return [$updateTransaction, $updateOrder];

    }
    public function failedCallBack(Request $request)
    {
        $ccCrypto = new CCCrypto();
        $avenue_payment = $ccCrypto->decrypt($request->encResp);

        $updateTransaction = CcAvenueTransaction::where('transaction_order_id', $avenue_payment['order_id'])->with(['order'])->first();
        $updateTransaction->tracking_id = $avenue_payment['tracking_id'];
        $updateTransaction->status = $avenue_payment['order_status'];
        $updateTransaction->payment_response_json = $avenue_payment;
        $updateTransaction->save();

        \Log::info($avenue_payment);
        $updateOrder = Order::where('id', $updateTransaction->order->id)->first();
        $updateOrder->status = "Payment Failed";
        $updateOrder->save();

        $url = "https://glosense.in/order-cancelled";
        return redirect()->away($url);

        // return [$updateTransaction, $updateOrder];
    }
}
