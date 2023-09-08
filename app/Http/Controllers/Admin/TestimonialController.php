<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\DataTables\TestimonialDataTable;

class TestimonialController extends Controller
{
    public function index(TestimonialDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.testimonial.testimonials', compact('pageConfigs'));
    }
    public function blockedTestimonial(TestimonialDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        $table->with('status', 'blocked');
        return $table->render('content.tables.testimonial.testimonials', compact('pageConfigs'));
    }
    public function store(Request $request)
    {

        $d = $request->validate([
            'name' => 'required|string',
            'designation' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,svg,webp|max:512'
        ]);
        // return $d;
        $image = FileUploader::uploadFile($request->file('image'), 'images/testimonial');
        Testimonial::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'description' => $request->description,
            'image' => $image
        ]);
        return response([
            'header' => 'Success!',
            'message' => 'Testimonial created successfully!',
            'table' => 'testimonial-table',
        ]);
    }
    public function edit($id)
    {
        $name = Testimonial::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
        $d = $request->validate([
            'id' => 'required|numeric|exists:testimonials,id',
            'name' => 'required|string',
            'designation' => 'nullable|string',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp,svg|max:512'
        ]);
        // return $d;
        $image = null;
        $testimonial = Testimonial::findOrFail($request->id);
        if ($request->has('image')) {
            $image = FileUploader::uploadFile($request->file('image'), 'images/testimonial');
        }
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->description = $request->description;
        ($image) ? $testimonial->image = $image : '';
        $testimonial->save();
        return response([
            'header' => 'Updated!',
            'message' => 'Testimonial updated successfully!',
            'table' => 'testimonial-table'
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:testimonials,id',
            'status' => 'required|in:active,blocked',
        ]);

        Testimonial::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'testimonial status updated successfully',
            'table' => 'testimonial-table',
        ]);
    }

    public function destroy($id)
    {
        Testimonial::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'testimonial deleted successfully',
            'table' => 'testimonial-table',
        ]);
    }
}
