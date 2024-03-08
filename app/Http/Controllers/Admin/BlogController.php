<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(BlogDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.blogs', compact('pageConfigs'));
    }

    public function create()
    {
        return view('content.tables.blog.add-blog');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'image' => 'required|file|max:1500',
            'short_description' => 'required',
            'content' => 'required',
        ]);

        $data = new Blog;
        $data->title = $request->title;
        $data->short_description = $request->short_description;
        $data->content = $request->content;
        if ($request->has('image')) {
            $url =  Storage::disk('do')->putFile('slider', $request->file('image'), 'public');
            $spaceUrl = Storage::disk('do')->url($url);
            $image = $spaceUrl;
            $data->image = $image;
        }
        $data->save();
        return response([
            'header' => 'Blog Added',
            'message' => 'Blog Added successfully',
            'table' => 'blog-table',
        ]);
    }
    public function edit($id)
    {
        $data = Blog::findOrFail($id);
        return view('content.tables.blog.edit-blog', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'id' => 'required',
            'image' => 'nullable|file|max:1500',
            'short_description' => 'required',
            'content' => 'required',
        ]);
        $data = Blog::where('id', $request->id)->first();
        $data->title = $request->title;
        $data->short_description = $request->short_description;
        $data->content = $request->content;
        if ($request->has('image')) {
            $url =  Storage::disk('do')->putFile('slider', $request->file('image'), 'public');
            $spaceUrl = Storage::disk('do')->url($url);
            $image = $spaceUrl;
            $data->image = $image;
        }
        $data->save();
        return response([
            'header' => 'Blog Updated',
            'message' => 'Blog Updated successfully',
            'table' => 'blog-table',
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:blogs,id',
            'status' => 'required|in:active,blocked',
        ]);

        Blog::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'blog status updated successfully',
            'table' => 'blog-table',
        ]);
    }

    public function destroy($id)
    {
        Blog::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'blog deleted successfully',
            'table' => 'blog-table',
        ]);
    }
}
