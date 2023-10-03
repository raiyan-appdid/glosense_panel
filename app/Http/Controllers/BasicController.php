<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicController extends Controller
{
    public function successCallBack(Request $request)
    {
        return $request->all();
    }
    public function failedCallBack(Request $request)
    {
        return "raiyan";
        return $request->all();
    }
}
