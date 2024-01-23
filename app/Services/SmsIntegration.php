<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsIntegration
{
    public static function action($phoneNumber, $message)
    {
        $apiKey = urlencode('NzU2NzMyMzc1ODU5NmQzOTZiNTU0MzYyNjUzMTQ0Njg=');
        $sender = urlencode('GLOSENSE');
        $response = Http::asForm()->accept('application/json')->post(
            'https://api.textlocal.in/send/',
            [
                'apikey' => $apiKey,
                'numbers' => $phoneNumber,
                'sender' => $sender,
                'message' => $message,
            ]
        );
        return $response->json();
    }
}
