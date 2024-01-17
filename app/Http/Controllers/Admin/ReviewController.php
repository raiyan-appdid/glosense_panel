<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Review;
use Illuminate\Http\Request;
use App\DataTables\ReviewDataTable;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function index(ReviewDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        $data = Review::first();
        $globalStar = $data->global_star ?? 0;
        $globalReviews = $data->global_reviews ?? 0;
        return $table->render('content.tables.reviews', compact('pageConfigs', 'globalStar', 'globalReviews'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'star' => 'nullable|integer|max:5|min:1'
        ]);
        $data = new Review;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->star = $request->star;
        $data->save();
        return response([
            'message' => 'Review Stored',
            'table' => 'review-table',
        ]);
    }
    public function edit($id)
    {
        $name = Review::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
        $request->validate([
            'star' => 'nullable|integer|max:5|min:1'
        ]);
        $data = Review::where('id', $request->id)->first();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->star = $request->star;
        $data->save();
        return response([
            'message' => 'Review Stored',
            'table' => 'review-table',
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:reviews,id',
            'status' => 'required|in:active,blocked',
        ]);

        Review::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'review status updated successfully',
            'table' => 'review-table',
        ]);
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'review deleted successfully',
            'table' => 'review-table',
        ]);
    }

    public function storeGlobalStar(Request $request)
    {
        $request->validate([
            'global_star' => 'required|max:5|min:0'
        ]);
        $data = Review::query()->update(['global_star' => $request->global_star]);
        return true;
    }
    public function storeGlobalreviews(Request $request)
    {
        $request->validate([
            'global_reviews' => 'required|integer'
        ]);
        $data = Review::query()->update(['global_reviews' => $request->global_reviews]);
        return true;
    }
}
