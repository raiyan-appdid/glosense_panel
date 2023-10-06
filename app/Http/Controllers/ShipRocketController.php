<?php

namespace App\Http\Controllers;

use App\Services\ShipRocket\CreateOrderService;
use App\Services\ShipRocket\GenerateTokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShipRocketController extends Controller
{
    public function getToken()
    {
        $token = new GenerateTokenService;
        $token = $token->getToken();
        return $token;
    }

    public function createOrder(Request $request, CreateOrderService $shiprocketOrder)
    {
        $token = $this->getToken();
        $response = $shiprocketOrder->create($token);
        return $response;
    }
}
