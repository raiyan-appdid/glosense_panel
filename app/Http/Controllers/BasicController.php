<?php

namespace App\Http\Controllers;

use App\Models\CcAvenueTransaction;
use App\Models\Order;
use App\Services\ccavenue\helpers\CCCrypto;
use App\Services\ShipRocket\CreateOrderService;
use App\Services\ShipRocket\GenerateTokenService;
use Illuminate\Http\Request;

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

        $token = new GenerateTokenService;
        $token = $token->getToken();

        $shiprocketOrder = new CreateOrderService;
        $response = $shiprocketOrder->create($token);

        $updateOrder = Order::where('id', $updateTransaction->order->id)->first();
        $updateOrder->status = $response['status'];
        $updateOrder->shipment_id = $response['shipment_id'];
        $updateOrder->save();
        return [$updateTransaction, $updateOrder];

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

        $updateOrder = Order::where('id', $updateTransaction->order->id)->first();
        $updateOrder->status = "Payment Failed";
        $updateOrder->save();




        $token = new GenerateTokenService;
        $token = $token->getToken();

        $shiprocketOrder = new CreateOrderService;
        $response = $shiprocketOrder->create($token);

        $updateOrder = Order::where('id', $updateTransaction->order->id)->first();
        $updateOrder->status = $response['status'];
        $updateOrder->shipment_id = $response['shipment_id'];
        $updateOrder->save();
        return [$updateTransaction, $updateOrder];



        // return [$updateTransaction, $updateOrder];
    }
}
