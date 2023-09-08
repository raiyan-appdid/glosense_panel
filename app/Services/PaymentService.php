<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use GuzzleHttp\Client;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\CashFreeOrder;
use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\DB;

class PaymentService
{



    public function fetchPayment(CashFreeOrder $order, ?User $user = null)
    {
        $client = new Client();
        if ($order->status !== 'pending') {
            return;
        }

        $response = $client->request('GET', 'https://sandbox.cashfree.com/pg/orders/' . $order->cf_order_id, [
            'headers' => [
                'accept' => 'application/json',
                'x-api-version' => '2022-09-01',
                'x-client-id' => '2884914efb592ddceb80b14f85194882',
                'x-client-secret' => '56b58f00007ba58fa6907a9242d4af2aec474a7b',
            ],
        ]);
        $payment_detail =  json_decode($response->getBody());
        \Log::info($payment_detail->order_status);
        \Log::info(now()->diffInMinutes($order->created_at));
        if ($payment_detail->order_status == 'PAID') {
            $cash_free_order_data = $order;

            $order_data = json_decode($cash_free_order_data->order_data);

            DB::beginTransaction();

            $delivery_address = DeliveryAddress::create([
                'user_id' => $order_data->shipping_address->user_id,
                'type' => $order_data->shipping_address->type,
                'name' => $order_data->shipping_address->name,
                'mobile' => $order_data->shipping_address->mobile,
                'address_one' => $order_data->shipping_address->address_one,
                'address_two' => $order_data->shipping_address->address_two,
                'city_id' => $order_data->shipping_address->city_id,
                'state_id' => $order_data->shipping_address->state_id,
                'pincode' => $order_data->shipping_address->pincode,
                'is_default' => $order_data->shipping_address->is_default,
            ]);

            $order = Order::create([
                'user_id' => $order_data->order->user_id,
                'mobile' => $order_data->order->mobile,
                'note' => $order_data->order->note,
                'total' => $order_data->order->total,
                'delivery_charges' => $order_data->order->delivery_charges,
                'promocode' => $order_data->order->promocode,
                'promocode_discount' => $order_data->order->promocode_discount,
                'final_total' => $order_data->order->final_total,
                'payment_method' => $order_data->order->payment_method,
                'shipping_address' => json_encode($order_data->order->shipping_address)
            ]);

            // $order_data->cart = array();

            foreach ($order_data->cart as $key => $cart) {
                $order_items = OrderItem::create([
                    'user_id' => $cart->user_id,
                    'order_id' => $order->id,
                    'product_id' => $cart->product->id,
                    'product_name' => $cart->product->title,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                    'discounted_price' => $cart->product->discounted_price,
                    'sub_total' => $cart->product->discounted_price * $cart->quantity
                ]);
            }

            $transaction = Transaction::create([
                'user_id' => $order_data->order->user_id,
                'order_id' => $order->id,
                'type' => $order_data->order->payment_method,
                'transaction_id' => $payment_detail->cf_order_id,
                'transaction_order_id' => $payment_detail->order_id,
                'amount' => $payment_detail->order_amount,
                'status' => $payment_detail->order_status,
                'message' => 'Order Placed',
                'cash_free_order_id' => $cash_free_order_data->id
            ]);

            CashFreeOrder::where('cf_order_id', $payment_detail->order_id)->where('cf_customer_id', $payment_detail->customer_details->customer_id)->update([
                'status' => 'success'
            ]);

            $cart = Cart::where('user_id', $order->user_id)->get();
            $cart->each->delete();
            DB::commit();
        } elseif ($payment_detail->order_status == 'FAILED' || now()->diffInMinutes($order->created_at) >= 120) {
            CashFreeOrder::where('cf_order_id', $payment_detail->order_id)->where('cf_customer_id', $payment_detail->customer_details->customer_id)->update([
                'status' => 'failed'
            ]);
        }
    }
}
