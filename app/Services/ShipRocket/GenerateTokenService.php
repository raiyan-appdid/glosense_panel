<?php

namespace App\Services\ShipRocket;

use App\Models\ShipRocket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class GenerateTokenService
{
    public function getToken()
    {
        $tokenExpired = ShipRocket::first();
        if ($tokenExpired?->updated_at >= Carbon::now()->subDays(8)) {
            //token not Expired
            return $tokenExpired->user_token;
        } else {
            $response = Http::post('https://apiv2.shiprocket.in/v1/external/auth/login', [
                'email' => env("SHIP_ROCKET_EMAIL"),
                'password' => env("SHIP_ROCKET_EMAIL_PASSWORD"),
            ]);
            $jsonData = $response->json();
            $storeToken = ShipRocket::updateOrCreate(
                ['id' => 1],
                ['user_token' => $jsonData['token']]
            );
            return $storeToken->user_token;
        }
    }
}
