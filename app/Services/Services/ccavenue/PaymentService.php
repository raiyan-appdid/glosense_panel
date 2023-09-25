<?php

namespace App\Services\ccavenue;

use Str;
use stdClass;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use App\Services\ccavenue\helpers\CCCrypto;
use App\Services\ccavenue\helpers\CCResponse;
use App\Services\ccavenue\helpers\PaymentConstants;


class PaymentService extends PaymentConstants
{



    /**
     * Create order on ccavenue
     *
     * @return CCResponse
     */


    public function createOrder(
        float|int $amount,
        string $redirect_url,
        string $cancel_url,
        ?array $additional_data = [],
    ): CCResponse {

        /** @var string */
        $data = "merchant_id=" . $this->merchantId . '&';
        $data .= "language=" . $this->language . '&';
        $data .= "currency=" . $this->currency . '&';
        $data .= "amount=" . $amount . '&';
        $data .= "redirect_url=" . $redirect_url . '&';
        $data .= "cancel_url=" . $cancel_url . '&';
        foreach ($additional_data as $key => $value) {
            $data .= $key . '=' . $value . '&';
        }
        $orderId = Str::uuid();
        $data .= "order_id=" . $orderId;
        return new CCResponse($data, $orderId);
    }




    public function fetchOrder($order_id): stdClass
    {
        $mode = (env('CC_MODE') === 'test') ? 'apitest' : 'api';
        $api_endpoint = 'https://' . $mode . '.ccavenue.com/apis/servlet/DoWebTrans';


        $ccCrypto = new CCCrypto();
        // dd(json_encode([
        //     'order_no' => $order_id
        // ], true));
        $encryptedData = $ccCrypto->encrypt(json_encode([
            'order_no' => $order_id
        ]));
        $params = [
            'enc_request' => $encryptedData,
            'access_code' => $this->accessCode,
            'command' => 'orderStatusTracker',
            'request_type' => 'JSON',
        ];

        $client = new Client();
        $response = $client->post($api_endpoint, ['form_params' => $params]);
        $res = $response->getBody()->getContents();

        $res_arr = [];

        parse_str($res, $res_arr);
        if ($res_arr['status'] !== "0") {
            throw new \Exception("Error from ccavenue : " . $res_arr['enc_response']);
        }
        $op = $ccCrypto->decrypt(str_replace(array("\r", "\n"), '', $res_arr['enc_response']));
        $op = array_key_first($op);


        return  json_decode($this->correctJson($op))->Order_Status_Result;
    }


    public function correctJson($json)
    {
        return preg_replace_callback('/"(.*?)"\s*:\s*([^,"}\]]+)/', function ($matches) {
            $key = $matches[1];
            $value = $matches[2];

            // Check if the value is numeric with an underscore
            if (is_numeric(str_replace('_', '', $value))) {
                // Replace underscore with dot
                $value = str_replace('_', '.', $value);
            }

            return '"' . $key . '":' . $value;
        }, $json);
    }
}
