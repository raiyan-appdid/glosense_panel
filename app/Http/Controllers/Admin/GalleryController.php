<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\DataTables\GalleryDataTable;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index(GalleryDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.gallery.gallerys', compact('pageConfigs'));
    }
    public function blockedImage(GalleryDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        $table->with('status', 'blocked');
        return $table->render('content.tables.gallery.gallerys', compact('pageConfigs'));
    }
    public function store(Request $request)
    {
        // $request->all();
        $request->validate([
            'image' => 'required|mimes:png,jpg,svg,webp,jpeg|max:512'
        ]);
        $image = FileUploader::uploadFile($request->file('image'), 'images/gallery');
        Gallery::create([
            'image' => $image
        ]);
        return response([
            'header' => 'Success!',
            'message' => 'Image added successfully!',
            'table' => 'gallery-table'
        ]);
    }
    public function edit($id)
    {
        $name = Gallery::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
        // return $request->all();
        $request->validate([
            'id' => 'required|numeric|exists:galleries,id',
            'image' => 'required|mimes:png,jpg,svg,webp,jpeg|max:512',
        ]);
        $gallery = Gallery::findOrFail($request->id);
        if ($request->has('image')) {
            $image = FileUploader::uploadFile($request->file('image'), 'images/gallery');
        }
        $gallery->image = $image;
        $gallery->save();
        return response([
            'header' => 'Updated!',
            'message' => 'Gallery updated successfully!',
            'table' => 'gallery-table'
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:galleries,id',
            'status' => 'required|in:active,blocked',
        ]);

        Gallery::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'gallery status updated successfully',
            'table' => 'gallery-table',
        ]);
    }

    public function destroy($id)
    {
        Gallery::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'gallery deleted successfully',
            'table' => 'gallery-table',
        ]);
    }
}
