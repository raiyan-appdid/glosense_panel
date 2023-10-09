<?php

namespace App\Http\Controllers\API\v1\Order;

use App\Http\Controllers\Controller;
use App\Models\CcAvenueOrder;
use App\Models\CcAvenueTransaction;
use App\Models\Order;
use App\Services\ccavenue\PaymentService;
use Illuminate\Http\Request;
use Str;

use function Termwind\render;

class CcAvenueOrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required',
            // 'address' => 'required',
            // 'city' => 'required',
            // 'state' => 'required',
            // 'pincode' => 'required',
            // 'country' => 'required',
            // 'number' => 'required',
            // 'email' => 'required',
            // 'total_price' => 'required',
        ]);
        $data = new Order;
        $data->order_id = mt_rand(100000, 999999);
        $data->user_id = $request->user_id;
        $data->name = $request->name;
        $data->address = $request->addresss;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->pincode = $request->pincode;
        $data->country = $request->country;
        $data->number = $request->number;
        $data->email = $request->email;
        $data->product_name = "Hair you glo";
        $data->units = 1;
        $data->price = 899;
        $data->discount = $request->discount;
        $data->sub_total = 899;
        $data->save();


        $CCAvenueorderId = Str::uuid();

        $transaction = new CcAvenueTransaction;
        $transaction->user_id = $data->user_id;
        $transaction->order_id = $data->id;
        $transaction->transaction_order_id = $CCAvenueorderId;
        $transaction->save();

        $paymentService = new PaymentService();

        $order = $paymentService->createOrder(
            amount: 1,
            redirect_url: route("ccavenue.success"),
            cancel_url: route("ccavenue.failed"),
            additional_data: ['billing_name' => $request->name, 'billing_tel' => $request->number, 'billing_email' => $request->email, 'billing_address' => $request->addresss, 'billing_zip' => $request->pincode, 'billing_tel' => $request->number, 'billing_city' => $request->city, 'billing_state' => $request->state, 'billing_country' => $request->country],
            CCAvenueorderId: $CCAvenueorderId,
        );
        // return 'raiyan';
        return $order->rendered();
    }
}
