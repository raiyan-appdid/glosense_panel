<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\BusinessSetting;
use Illuminate\Http\Request;
use App\DataTables\BusinessSettingDataTable;
use App\Http\Controllers\Controller;

class BusinessSettingController extends Controller
{
    public function index(BusinessSettingDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        $businessSettings = BusinessSetting::all();
        foreach ($businessSettings as $data) {
            $info[] = [
                $data->key => $data->value,
            ];
        }
        $businessSettings = (!$businessSettings->isEmpty()) ? (array_merge(...$info)) : [];
        // $table->with('id', 1);
        return $table->render('content.tables.businesssetting.businesssettings', compact('pageConfigs', 'businessSettings'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255|email',
            'phone' => 'required|numeric|digits:10',
            'address' => 'required|max:255',
            'footer_desc' => 'required',
            'header_offer' => 'required',
            'facebook' => 'required|url',
            'instagram' => 'required|url',
            'youtube' => 'required|url',
            'twitter' => 'nullable|url',
            'whatsapp' => 'required'
        ]);
        // return $request->all();

        // BusinessSetting::updateOrInsert(['key' => $request->email], ['value' => $request->email]);
        foreach ($request->only('email', 'phone', 'address', 'footer_desc', 'header_offer', 'facebook', 'instagram', 'youtube', 'twitter', 'whatsapp') as $key => $value) {
            BusinessSetting::updateOrInsert(['key' => $key], ['value' => $value]);
        }

        return response([
            'success'  => 'Business Settings updated sucessfully!',
        ]);
    }
    public function edit($id)
    {
        $name = BusinessSetting::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:businesssettings,id',
            'status' => 'required|in:active,blocked',
        ]);

        BusinessSetting::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'businesssetting status updated successfully',
            'table' => 'businesssetting-table',
        ]);
    }

    public function destroy($id)
    {
        BusinessSetting::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'businesssetting deleted successfully',
            'table' => 'businesssetting-table',
        ]);
    }
}
