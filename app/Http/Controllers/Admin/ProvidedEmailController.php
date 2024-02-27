<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\ProvidedEmail;
use Illuminate\Http\Request;
use App\DataTables\ProvidedEmailDataTable;
use App\Http\Controllers\Controller;

class ProvidedEmailController extends Controller
{
    public function index(ProvidedEmailDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.providedemails', compact('pageConfigs'));
    }
    public function store(Request $request)
    {
    }
    public function edit($id)
    {
        $name = ProvidedEmail::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:providedemails,id',
            'status' => 'required|in:active,blocked',
        ]);

        ProvidedEmail::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'providedemail status updated successfully',
            'table' => 'providedemail-table',
        ]);
    }

    public function destroy($id)
    {
        ProvidedEmail::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'providedemail deleted successfully',
            'table' => 'providedemail-table',
        ]);
    }
}
