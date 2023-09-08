<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index(SliderDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.slider.sliders', compact('pageConfigs'));
    }
    public function blockedSliders(SliderDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        $table->with('status', 'blocked');
        return $table->render('content.tables.slider.sliders', compact('pageConfigs'));
    }
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg,svg,webp|max:512'
        ]);
        $image = FileUploader::uploadFile($request->file('image'), 'images/sliders');
        Slider::create([
            'image' => $image
        ]);
        return response([
            'header' => 'Success!',
            'message' => 'Slider created successfully!',
            'table' => 'slider-table'
        ]);
    }
    public function edit($id)
    {
        $name = Slider::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
        // return $request->all();
        $request->validate([
            'id' => 'required|exists:sliders,id|numeric',
            'image' => 'required|mimes:png,jpg,jpeg,svg,webp'
        ]);
        $slider = Slider::findOrFail($request->id);
        if ($request->has('image')) {
            $image = FileUploader::uploadFile($request->file('image'), 'images/sliders');
        }
        $slider->image = $image;
        $slider->save();
        return response([
            'header' => 'Updated!',
            'message' => 'Slider updated successfully!',
            'table' => 'slider-table'
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:sliders,id',
            'status' => 'required|in:active,blocked',
        ]);

        Slider::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'slider status updated successfully',
            'table' => 'slider-table',
        ]);
    }

    public function destroy($id)
    {
        Slider::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'slider deleted successfully',
            'table' => 'slider-table',
        ]);
    }
}
