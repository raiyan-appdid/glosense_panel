<?php

namespace App\Services\ShipRocket;

use App\Models\ShipRocket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class CreateOrderService
{
    public function create($token, $updateOrder)
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer $token",
            "Content-Type" => "application/json",
        ])->post('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc', [
            "order_id" => $updateOrder->order_id,
            "order_date" => now(),
            "pickup_location" => "Primary",
            // "channel_id" => "",
            // "comment" => "Reseller=> M/s Goku",
            "billing_customer_name" => $updateOrder->name,
            "billing_last_name" => "",
            "billing_address" => $updateOrder->address,
            "billing_city" => $updateOrder->city,
            "billing_pincode" => $updateOrder->pincode,
            "billing_state" => $updateOrder->state,
            "billing_country" => $updateOrder->country,
            "billing_email" => $updateOrder->email,
            "billing_phone" => $updateOrder->number,
            "shipping_is_billing" => true,
            // "shipping_customer_name" => "",
            // "shipping_last_name" => "",
            // "shipping_address" => "",
            // "shipping_address_2" => "",
            // "shipping_city" => "",
            // "shipping_pincode" => "",
            // "shipping_country" => "",
            // "shipping_state" => "",
            // "shipping_email" => "",
            // "shipping_phone" => "",
            "order_items" => [
                [
                    "name" => "Hair you glo",
                    "sku" => "test123",
                    "units" => $updateOrder->units,
                    "selling_price" => $updateOrder->sub_total,
                    "discount" => "",
                ],
            ],
            "payment_method" => "Prepaid",
            "shipping_charges" => 0,
            "giftwrap_charges" => 0,
            "transaction_charges" => 0,
            "total_discount" => $updateOrder->discount,
            "sub_total" => $updateOrder->sub_total,
            "length" => 9.5,
            "breadth" => 9.5,
            "height" => 9.5,
            "weight" => 0.5,
        ]);
        $res = $response->json();
        return $res;
    }
}
