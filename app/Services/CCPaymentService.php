<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Mail\Invoice;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\CCAvenueOrder;
use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CCPaymentService
{
    public function fetchPayment(CCAvenueOrder $order, ?User $user = null, $avenue_payment)
    {
        if ($order->status !== 'Awaited') {
            return;
        }
        \Log::info("message");
        $succesCallback = ['Success', 'Shipped'];
        $failureCallback = ['Failure', 'Aborted', 'Auto-Cancelled', 'Cancelled', 'Invalid', 'Fraud', 'Initiated', 'Unsuccessful', 'Refunded'];
        if (in_array($avenue_payment['order_status'], $succesCallback)) {
            $cc_avenue_order_data = $order;

            $order_data = json_decode($cc_avenue_order_data->order_data);

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
                'cc_order_id' => $avenue_payment['order_id'],
                'cc_tracking_id' => $avenue_payment['tracking_id'],
                'c_c_avenue_order_id' => $cc_avenue_order_data->id,
                'cc_response_data' => json_encode($avenue_payment),
                'amount' => $avenue_payment['amount'],
                'status' => $avenue_payment['order_status'],
                'message' => 'Order Placed',
            ]);

            CCAvenueOrder::where('cc_avenue_order_id', $avenue_payment['order_id'])->where('user_id', $order_data->order->user_id)->update([
                'status' => 'Shipped'
            ]);

            $cart = Cart::where('user_id', $order->user_id)->get();
            $cart->each->delete();


            DB::commit();
            $order_data = Order::with(['user', 'orderItem', 'transaction'])->findOrFail($order->id);
            $data = $order_data;
            // return $data;         
            $mail = Mail::to('gouseg185@gmail.com')->send(new Invoice($data));
        } elseif (in_array($avenue_payment['order_status'], $failureCallback)) {
            CCAvenueOrder::where('cc_avenue_order_id', $avenue_payment['order_id'])->where('user_id', $order->user_id)->update([
                'status' => 'Failure'
            ]);
        }
    }
}
