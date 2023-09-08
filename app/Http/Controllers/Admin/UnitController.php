<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\DataTables\UnitDataTable;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    public function index(UnitDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.unit.units', compact('pageConfigs'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Unit::create([
            'name' => $request->name
        ]);
        return response([
            'header' => ' Success!',
            'message' => 'Unit created successfuly!',
            'table' => 'unit-table'
        ]);
    }
    public function edit($id)
    {
        $name = Unit::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:units,id',
            'name' => 'required'
        ]);
        $unit = Unit::findOrFail($request->id);
        $unit->update([
            'name' => $request->name
        ]);

        return response([
            'header' => 'Success!',
            'message' => 'Updated successfully!',
            'table' => 'unit-table'
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:units,id',
            'status' => 'required|in:active,blocked',
        ]);

        Unit::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'unit status updated successfully',
            'table' => 'unit-table',
        ]);
    }

    public function destroy($id)
    {
        Unit::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'unit deleted successfully',
            'table' => 'unit-table',
        ]);
    }
}
