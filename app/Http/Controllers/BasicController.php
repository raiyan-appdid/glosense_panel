<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicController extends Controller
{
    public function successCallBack(Request $request)
    {
        return $request->all();
    }
    public function failedCallBack($gateway, Request $request)
    {
        return $gateway;
        return "raiyan";
        return $request->all();
    }
}
