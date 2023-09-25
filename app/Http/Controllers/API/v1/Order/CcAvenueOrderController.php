<?php

namespace App\Http\Controllers\API\v1\Order;

use App\Http\Controllers\Controller;
use App\Models\CcAvenueOrder;
use Illuminate\Http\Request;

class CcAvenueOrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'country' => 'required',
            'number' => 'required',
            'email' => 'required',
            'total_price' => 'required',
        ]);
        $data = new CcAvenueOrder;
        $data->user_id = $request->user()->id;
        $data->name = $request->name;
        $data->address = $request->address;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->pincode = $request->pincode;
        $data->country = $request->country;
        $data->number = $request->number;
        $data->email = $request->email;
        $data->total_price = $request->total_price;
        $data->save();
        return response([
            'success' => true,
            'message' => "Order Created",
        ]);
    }
}
