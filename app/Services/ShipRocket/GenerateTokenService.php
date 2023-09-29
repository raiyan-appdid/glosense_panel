<?php

namespace App\Services\ShipRocket;

use Illuminate\Support\Facades\Http;

class GenerateTokenService
{
    public function getToken()
    {
        $response = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
            'email' => env("SHIP_ROCKET_EMAIL"),
            'password' => env("SHIP_ROCKET_EMAIL_PASSWORD"),
        ]);
        $jsonData = $response->json();
        return $jsonData['token'];
    }
}
