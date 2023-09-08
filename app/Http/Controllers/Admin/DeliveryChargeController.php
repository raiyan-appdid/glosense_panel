<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\DeliveryCharge;
use Illuminate\Http\Request;
use App\DataTables\DeliveryChargeDataTable;
use App\Http\Controllers\Controller;

class DeliveryChargeController extends Controller
{
    public function index(DeliveryChargeDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        $deliverycharges = DeliveryCharge::all();
        foreach ($deliverycharges as $data) {
            $info[] = [
                $data->key => $data->value,
            ];
        }
        $deliverycharges = (!$deliverycharges->isEmpty()) ? (array_merge(...$info)) : [];

        return $table->render('content.tables.delivery-charge.deliverycharges', compact('pageConfigs', 'deliverycharges'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'within' => 'required',
            'out_of' => 'required'
        ]);
        // return $request->all();

        foreach ($request->only('within', 'out_of') as $key => $value) {
            DeliveryCharge::updateOrInsert(['key' => $key], ['value' => $value]);
        }
        return response([
            'message' => 'Delivery charges updated!'
        ]);
    }
    public function edit($id)
    {
        $name = DeliveryCharge::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:deliverycharges,id',
            'status' => 'required|in:active,blocked',
        ]);

        DeliveryCharge::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'deliverycharge status updated successfully',
            'table' => 'deliverycharge-table',
        ]);
    }

    public function destroy($id)
    {
        DeliveryCharge::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'deliverycharge deleted successfully',
            'table' => 'deliverycharge-table',
        ]);
    }
}
