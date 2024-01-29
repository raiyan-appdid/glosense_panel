<?php

namespace App\Services\CashFree;

use Illuminate\Support\Facades\Http;

class CashFreePaymentService
{
    public $apiKey;
    public $apiSecret;
    public $createOrderUrl;
    public $apiVersion = '2022-09-01';

    public function __construct()
    {
        $cashfreeEnvironment = env('CASHFREE_ENVIRONMENT');
        if ($cashfreeEnvironment == "TEST") {
            $this->apiKey = env('CASHFREE_TEST_API_KEY');
            $this->apiSecret = env('CASHFREE_TEST_SECRET_KEY');
            $this->createOrderUrl = "https://sandbox.cashfree.com/pg/orders";
        } else {
            $this->apiKey = env('CASHFREE_LIVE_API_KEY');
            $this->apiSecret = env('CASHFREE_LIVE_SECRET_KEY');
            $this->createOrderUrl = "https://api.cashfree.com/pg/orders";
        }
    }

    public function createOrder($orderId, $userData)
    {
        try {
            $response = Http::withHeaders([
                'x-client-id' => $this->apiKey,
                'x-client-secret' => $this->apiSecret,
                'x-api-version' => $this->apiVersion,
            ])->accept('application/json')->post(
                $this->createOrderUrl,
                [
                    'order_amount' => 20,
                    'order_currency' => 'INR',
                    "customer_details" =>  [
                        "customer_id" =>  $userData->id,
                        "customer_name" => $userData->name,
                        "customer_email" =>  $userData->email,
                        "customer_phone" => $userData->phone
                    ],
                    "order_meta" => [
                        "return_url" => "https://b8af79f41056.eu.ngrok.io?order_id={order_id}",
                        "notify_url" => "https://b8af79f41056.eu.ngrok.io/webhook.php",
                    ]
                ]
            );
            if ($response->status() == 200) {
                return [
                    'status' => true,
                    'response' => $response->json()
                ];
            } else {
                return [
                    'status' => false,
                    'message' => "Some data is incorrect"
                ];
            }
        } catch (\Throwable $th) {
            \Log::info("-------Error while creating order start-----------");
            \Log::info($th);
            \Log::info("-------Error while creating order end-----------");
            return [
                'status' => false,
            ];
        }
    }
}
