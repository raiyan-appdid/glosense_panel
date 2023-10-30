<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Promocode;
use Illuminate\Http\Request;
use App\DataTables\PromocodeDataTable;
use App\Http\Controllers\Controller;

class PromocodeController extends Controller
{
    public function index(PromocodeDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.promocode.promocodes', compact('pageConfigs'));
    }
    public function store(Request $request)
    {
        // $request->validate([
        //     'promocode' => 'required',
        //     'message' => 'required',
        //     'minimum_order_amount' => 'required|numeric',
        //     'start_date' => 'required|date',
        //     'end_date' => 'required',
        //     'max_discount_amount' => 'required|numeric',
        //     'discount' => 'required|numeric',
        //     'discount_type' => 'required',
        // ]);
        // return $request->all();
        Promocode::create([
            'promocode' => $request->promocode,
            'message' => "test",
            'start_date' => now(),
            'end_date' => now(),
            'minimum_order_amount' => 1,
            'max_discount_amount' => 1,
            'discount' => $request->discount,
            'discount_type' => 'flat',
        ]);

        return response([
            'header' => 'Success!',
            'message' => 'Promocode created successfully!',
            'table' => 'promocode-table'
        ]);
    }
    public function edit($id)
    {
        $name = Promocode::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
        // $request->validate([
        //     'id' => 'required|numeric|exists:promocodes,id',
        //     'promocode' => 'required',
        //     'message' => 'required',
        //     'minimum_order_amount' => 'required|numeric',
        //     'start_date' => 'required|date',
        //     'end_date' => 'required',
        //     'max_discount_amount' => 'required|numeric',
        //     'discount' => 'required|numeric',
        //     'discount_type' => 'required',
        // ]);
        // return $request->all();

        $promocode = Promocode::findOrFail($request->id)->update([
            'promocode' => $request->promocode,
            'message' => "test",
            'start_date' => now(),
            'end_date' => now(),
            'minimum_order_amount' => 1,
            'max_discount_amount' => 1,
            'discount' => $request->discount,
            'discount_type' => 'flat',
        ]);
        return response([
            'header' => 'Success!',
            'message' => 'Promocode updated successfully!',
            'table' => 'promocode-table'
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:promocodes,id',
            'status' => 'required|in:active,blocked',
        ]);

        Promocode::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'promocode status updated successfully',
            'table' => 'promocode-table',
        ]);
    }

    public function destroy($id)
    {
        Promocode::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'promocode deleted successfully',
            'table' => 'promocode-table',
        ]);
    }
}
