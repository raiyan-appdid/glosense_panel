<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\DataTables\EnquiryDataTable;
use App\Http\Controllers\Controller;

class EnquiryController extends Controller
{
    public function index(EnquiryDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.enquiry.enquirys', compact('pageConfigs'));
    }
    public function store(Request $request)
    {
    }
    public function edit($id)
    {
        $name = Enquiry::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:enquirys,id',
            'status' => 'required|in:active,blocked',
        ]);

        Enquiry::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'enquiry status updated successfully',
            'table' => 'enquiry-table',
        ]);
    }

    public function destroy($id)
    {
        Enquiry::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'enquiry deleted successfully',
            'table' => 'enquiry-table',
        ]);
    }
}
