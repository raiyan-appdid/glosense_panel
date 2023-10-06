<?php

namespace App\Services\ShipRocket;

use App\Models\ShipRocket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class CreateOrderService
{
    public function create($token)
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer $token",
            "Content-Type" => "application/json",
        ])->post('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc', [
            "order_id" => "224-901",
            "order_date" => "2023-07-24 11:11",
            "pickup_location" => "Primary",
            // "channel_id" => "",
            // "comment" => "Reseller=> M/s Goku",
            "billing_customer_name" => "Naruto",
            "billing_last_name" => "",
            "billing_address" => "806, 8th floor, Sunshine Tower, near Dadar Phool Market, Senapati Bapat Marg, Dadar",
            "billing_city" => "Mumbai",
            "billing_pincode" => "400013",
            "billing_state" => "Maharashtra",
            "billing_country" => "India",
            "billing_email" => "naruto@uzumaki.com",
            "billing_phone" => "8097750991",
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
                    "units" => 10,
                    "selling_price" => "900",
                    "discount" => "",
                ],
            ],
            "payment_method" => "Prepaid",
            "shipping_charges" => 0,
            "giftwrap_charges" => 0,
            "transaction_charges" => 0,
            "total_discount" => 0,
            "sub_total" => 10,
            "length" => 9.5,
            "breadth" => 9.5,
            "height" => 9.5,
            "weight" => 0.5,
        ]);
        $res = $response->json();
        return $res;
    }
}
