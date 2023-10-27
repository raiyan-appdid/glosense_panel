<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\CcAvenueTransaction;
use Illuminate\Http\Request;
use App\DataTables\CcAvenueTransactionDataTable;
use App\Http\Controllers\Controller;

class CcAvenueTransactionController extends Controller
{
    public function index(CcAvenueTransactionDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.ccavenuetransactions', compact('pageConfigs'));
    }
    public function store(Request $request)
    {
    }
    public function edit($id)
    {
        $name = CcAvenueTransaction::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:ccavenuetransactions,id',
            'status' => 'required|in:active,blocked',
        ]);

        CcAvenueTransaction::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'ccavenuetransaction status updated successfully',
            'table' => 'ccavenuetransaction-table',
        ]);
    }

    public function destroy($id)
    {
        CcAvenueTransaction::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'ccavenuetransaction deleted successfully',
            'table' => 'ccavenuetransaction-table',
        ]);
    }
}
