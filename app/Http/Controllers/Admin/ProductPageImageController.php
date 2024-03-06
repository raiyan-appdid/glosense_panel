<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\ProductPageImage;
use Illuminate\Http\Request;
use App\DataTables\ProductPageImageDataTable;
use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductPageImageController extends Controller
{
    public function index(ProductPageImageDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.productpageimages', compact('pageConfigs'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => 'required|file|max:1500',
                'rank' => 'required',
            ],

            [
                'image.max' => 'Image Must Be smaller than 1.5 MB',
            ]
        );
        $url =  Storage::disk('do')->putFile('slider', $request->file('image'), 'public');
        $spaceUrl = Storage::disk('do')->url($url);
        $image = $spaceUrl;
        ProductPageImage::create([
            'image' => $image,
            'rank' => $request->rank,
        ]);
        return response([
            'header' => 'Success!',
            'message' => 'Image added successfully!',
            'table' => 'productpageimage-table'
        ]);
    }
    public function edit($id)
    {
        $name = ProductPageImage::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
                'image' => 'nullable|file|max:1500',
                'rank' => 'required',
            ],

            [
                'image.max' => 'Image Must Be smaller than 1.5 MB',
            ]
        );
        $slider = ProductPageImage::findOrFail($request->id);
        if ($request->has('image')) {
            $url =  Storage::disk('do')->putFile('slider', $request->file('image'), 'public');
            $spaceUrl = Storage::disk('do')->url($url);
            $image = $spaceUrl;
            $slider->image = $image;
        }
        $slider->rank = $request->rank;
        $slider->save();
        return response([
            'header' => 'Updated!',
            'message' => 'Image updated successfully!',
            'table' => 'productpageimage-table'
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:product_page_images,id',
            'status' => 'required|in:active,blocked',
        ]);

        ProductPageImage::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'productpageimage status updated successfully',
            'table' => 'productpageimage-table',
        ]);
    }

    public function destroy($id)
    {
        ProductPageImage::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'productpageimage deleted successfully',
            'table' => 'productpageimage-table',
        ]);
    }
}
