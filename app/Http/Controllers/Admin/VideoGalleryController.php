<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\DataTables\VideoGalleryDataTable;

class VideoGalleryController extends Controller
{
    public function index(VideoGalleryDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.video-gallery.videogallerys', compact('pageConfigs'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable',
            'url' => 'required_without:video',
            'video' => 'required_without:url|mimes:mp4,mov,ogg,qt | max:20000',
            'video_type' => 'required'
        ]);
        // return $request->all();
        if ($request->video_type == 'video') {
            VideoGallery::create([
                'title' => $request->title,
                'video_type' => $request->video_type,
                'video_url' => FileUploader::uploadFile($request->video, 'images/video-gallery'),
            ]);
        } else {
            VideoGallery::create([
                'title' => $request->title,
                'video_type' => $request->video_type,
                'video_url' => $request->url
            ]);
        }
        return response([
            'header' => 'Success!',
            'message' => 'Video added successfully!',
            'table' => 'videogallery-table'
        ]);
    }
    public function edit($id)
    {
        $name = VideoGallery::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:video_galleries,id',
            'title' => 'nullable',
            'url' => 'nullable|url',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt | max:20000',
            'edit_video_type' => 'required'
        ]);
        if ($request->edit_video_type == 'video') {
            $edit_video = FileUploader::uploadFile($request->video, 'images/video-gallery');
            $video = VideoGallery::findOrFail($request->id);
            $video->title = $request->title;
            $video->video_type = $request->edit_video_type;
            ($edit_video) ? $video->video_url = $edit_video : '';
            $video->save();
        } else {
            VideoGallery::findOrFail($request->id)->update([
                'title' => $request->title,
                'video_type' => $request->edit_video_type,
                'video_url' => $request->url
            ]);
        }

        return response([
            'header' => 'Updated!',
            'message' => 'Video updated successfully!',
            'table' => 'videogallery-table'
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:video_galleries,id',
            'status' => 'required|in:active,blocked',
        ]);

        VideoGallery::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'video status updated successfully',
            'table' => 'videogallery-table',
        ]);
    }

    public function destroy($id)
    {
        VideoGallery::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'video deleted successfully',
            'table' => 'videogallery-table',
        ]);
    }
}
