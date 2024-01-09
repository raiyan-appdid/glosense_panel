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
        return $table->render('content.tables.reviews', compact('pageConfigs'));
    }
    public function store(Request $request)
    {
    }
    public function edit($id)
    {
        $name = Review::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
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
}
