<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Analytic;
use Illuminate\Http\Request;
use App\DataTables\AnalyticDataTable;
use App\Http\Controllers\Controller;

class AnalyticController extends Controller
{
    public function index(AnalyticDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.analytics', compact('pageConfigs'));
    }
    public function store(Request $request)
    {
    }
    public function edit($id)
    {
        $name = Analytic::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:analytics,id',
            'status' => 'required|in:active,blocked',
        ]);

        Analytic::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'analytic status updated successfully',
            'table' => 'analytic-table',
        ]);
    }

    public function destroy($id)
    {
        Analytic::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'analytic deleted successfully',
            'table' => 'analytic-table',
        ]);
    }
}
