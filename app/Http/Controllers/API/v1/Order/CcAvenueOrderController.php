<?php

namespace App\Http\Controllers\API\v1\Order;

use App\Http\Controllers\Controller;
use App\Models\CcAvenueOrder;
use App\Services\ccavenue\PaymentService;
use Illuminate\Http\Request;

use function Termwind\render;

class CcAvenueOrderController extends Controller
{
    public function store(Request $request)
    {
        // return "raiyan";
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
        // return "raiyan";
        $data = new CcAvenueOrder;
        // $data->user_id = $request->user()->id;
        $data->name = $request->name;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->pincode = $request->pincode;
        $data->country = $request->country;
        $data->number = $request->number;
        $data->email = $request->email;
        $data->total_price = $request->total_price;
        $data->save();
        // return response([
        //     'success' => true,
        //     'message' => "Order Created",
        // ]);
        $paymentService = new PaymentService();

        $order = $paymentService->createOrder(
            amount: 1,
            redirect_url: route("ccavenue.success"),
            cancel_url: route("ccavenue.failed"),
            additional_data: ['billing_name' => $request->name, 'billing_tel' => $request->number, 'billing_email' => $request->email, 'address' => $request->address, 'zipcode' => $request->pincode, 'mobile_number' => $request->pincode]
        );
        // return 'raiyan';
        return $order->rendered();
    }
}
