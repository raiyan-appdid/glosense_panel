<?php

namespace App\Http\Controllers;

use App\Services\ShipRocket\GenerateTokenService;
use Illuminate\Http\Request;

class ShipRocketController extends Controller
{
    public function createOrder(Request $request)
    {
        $token = new GenerateTokenService;
        $token = $token->getToken();
        dd($token);
    }
}
