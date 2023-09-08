<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\DataTables\BlogDataTable;
use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use Str;

class BlogController extends Controller
{
    public function index(BlogDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.blog.blogs', compact('pageConfigs'));
    }
    public function blockedBlog(BlogDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        $table->with('status', 'blocked');
        return $table->render('content.tables.blog.blogs', compact('pageConfigs'));
    }
    public function create()
    {
        return view('content.tables.blog.add-blog');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required',
            'image' => 'required|mimes:png,jpg,svg,jpeg,webp',
        ]);
        // return $request->all();
        $image = FileUploader::uploadFile($request->file('image'), 'images/blog');
        Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $image
        ]);
        return response([
            'header' => 'Success!',
            'message' => 'Blog created successfully!',
            'table' => 'blog-table',
            'route' => 'admin/blogs'
        ]);
    }
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('content.forms.edit-blog', compact('blog'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required',
            'image' => '|mimes:png,jpg,svg,jpeg,webp',
        ]);
        // return $request->all();
        $image = null;
        $blog = Blog::findOrFail($request->id);
        if ($request->has('file')) {
            $image = FileUploader::uploadFile($request->file('image'), 'images/blog');
        }
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->content = $request->content;
        ($image) ? $blog->image = $image : '';
        $blog->save();
        return response([
            'header' => 'Updated!',
            'message' => 'Blog created successfully!',
            'table' => 'blog-table'
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
