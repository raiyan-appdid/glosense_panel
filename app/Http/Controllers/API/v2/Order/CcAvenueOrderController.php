<?php

namespace App\Http\Controllers\API\v2\Order;

use App\Http\Controllers\Controller;
use App\Models\CcAvenueOrder;
use App\Models\CcAvenueTransaction;
use App\Models\Order;
use App\Models\Promocode;
use App\Models\User;
use App\Services\CashFree\CashFreePaymentService;
use App\Services\ccavenue\PaymentService;
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
        $data->payment_gateway = 'cashfree';
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

        //create order in cashfree
        $userData = User::where('id', $request->user_id)->first();
        $order =  $cashFreePaymentService->createOrder($data->order_id, $userData);
        if ($order['status']) {
            \Log::info($order);
            $cf_order_id =  $order['response']->cf_order_id;
            $payment_session_id =  $order['response']->payment_session_id;
            $cash_free_order_id =  $order['response']->order_id;
            $order_status =  $order['response']->order_status;

            $transaction = new CcAvenueTransaction;
            $transaction->user_id = $data->user_id;
            $transaction->order_id = $data->id;
            $transaction->payment_gateway = 'cashfree';
            $transaction->cf_order_id = $cf_order_id;
            $transaction->status = $order_status;
            $transaction->payment_session_id = $payment_session_id;
            $transaction->cash_free_order_id = $cash_free_order_id;
            $transaction->save();

            $CashfreeEnvironment = env('CASHFREE_ENVIRONMENT');
            return view('pages.cashfree.checkout', compact('CashfreeEnvironment', 'payment_session_id'));
        } else {
            return response([
                'success' => true,
                'message' => 'Error While Creating order Id in Cashfree check logs'
            ]);
        }
    }
}
