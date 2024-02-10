<?php

namespace App\Http\Controllers\API\v3\Order;

use App\Http\Controllers\Controller;
use App\Models\CcAvenueOrder;
use App\Models\CcAvenueTransaction;
use App\Models\Order;
use App\Models\Promocode;
use App\Models\User;
use App\Services\CashFree\CashFreePaymentService;
use App\Services\ccavenue\PaymentService;
use App\Services\RazorPayIntegration;
use Illuminate\Http\Request;
use PDO;
use Str;

use function Termwind\render;

class CcAvenueOrderController extends Controller
{
    public function store(Request $request, CashFreePaymentService $cashFreePaymentService)
    {
        // return $request->all();
        $request->validate([
            // 'tnc' => 'required',
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

        try {
            $userStore = User::where('id', $request->user_id)->first();
            $userStore->email = $request->email;
            $userStore->first_name = $request->name;
            $userStore->save();
        } catch (\Throwable $th) {
            \Log::info($th);
        }




        $data = new Order;
        $data->order_id = "ord_" . mt_rand(100000, 999999);
        $data->user_id = $request->user_id;
        $data->name = $request->name;
        $data->address = $request->addresss;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->pincode = $request->pincode;
        $data->country = $request->country;
        $data->number = $request->number;
        $data->payment_gateway = 'razorpay test';
        $data->email = $request->email;
        $data->product_name = "Hair you glo";
        $data->units = $request->units;
        $data->gst = $request->gst;
        if ($request->promocode_id) {
            try {
                $data->promocode_id = $request->promocode_id;
            } catch (\Throwable $th) {
                \Log::info($th);
            }
        }

        $data->price = $request->sub_total;
        $data->sub_total = $request->total;
        $data->discount = $request->discount;
        $data->save();

        $orderId = $data->order_id;
        $userName = $data->name;
        $userEmail = $data->email;
        $userNumber = $data->number;
        //create order in razorpay
        $userData = User::where('id', $request->user_id)->first();
        $razorPayOrderId = RazorPayIntegration::createOrder($data->sub_total);
        if ($razorPayOrderId['success']) {

            $rzrOdId = $razorPayOrderId['razorpay_order_id'];

            $transaction = new CcAvenueTransaction;
            $transaction->user_id = $data->user_id;
            $transaction->order_id = $data->id;
            $transaction->payment_gateway = 'razorpay live';
            $transaction->razorpay_order_id = $rzrOdId;
            $transaction->save();

            return view('pages.razorpay.checkout', compact('rzrOdId', 'orderId', 'userName', 'userEmail', 'userEmail'));
        } else {
            return response([
                'success' => false,
                'message' => 'Error While Creating order Id in Cashfree check logs'
            ]);
        }
    }
}
