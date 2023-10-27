<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Order;
use Illuminate\Http\Request;
use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(OrderDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.orders', compact('pageConfigs'));
    }
    public function store(Request $request)
    {
    }
    public function edit($id)
    {
        $name = Order::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:orders,id',
            'status' => 'required|in:active,blocked',
        ]);

        Order::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'order status updated successfully',
            'table' => 'order-table',
        ]);
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'order deleted successfully',
            'table' => 'order-table',
        ]);
    }
}
