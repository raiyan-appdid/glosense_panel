<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsIntegration
{
    public static function action($phoneNumber, $message)
    {
        $apiKey = urlencode('hSujJlRSq2I-XEo8CBoacqW8di87eBZKo8O6vniWOf');
        $sender = urlencode('APPDID');
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
