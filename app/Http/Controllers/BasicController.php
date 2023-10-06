<?php

namespace App\Http\Controllers;

use App\Services\ccavenue\helpers\CCCrypto;
use Illuminate\Http\Request;

class BasicController extends Controller
{
    public function successCallBack(Request $request)
    {
        $ccCrypto = new CCCrypto();
        $avenue_payment = $ccCrypto->decrypt($request->encResp);
        return $avenue_payment['order_status'];
    }
    public function failedCallBack(Request $request)
    {
        $ccCrypto = new CCCrypto();
        $avenue_payment = $ccCrypto->decrypt($request->encResp);
        return $avenue_payment;
    }
}
