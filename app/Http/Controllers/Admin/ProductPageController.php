<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\ProductPage;
use Illuminate\Http\Request;
use App\DataTables\ProductPageDataTable;
use App\Http\Controllers\Controller;

class ProductPageController extends Controller
{
    public function index()
    {
        $data = ProductPage::where('id', 1)->first();
        return view('content.tables.productpages', compact('data'));
    }
    public function store(Request $request)
    {
        $data = ProductPage::where('id', 1)->first();
        if ($data) {
            $data->text_1 = $request->text_1;
            $data->text_2 = $request->text_2;
            $data->save();
        } else {
            $data = new ProductPage;
            $data->text_1 = $request->text_1;
            $data->text_2 = $request->text_2;
            $data->save();
        }
        return response([
            'header' => 'Success',
            'table' => 'productpage-table',
        ]);
    }
    public function edit($id)
    {
        $name = ProductPage::findOrFail($id);
        return response($name);
    }

    public function update(Request $request)
    {
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:productpages,id',
            'status' => 'required|in:active,blocked',
        ]);

        ProductPage::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'productpage status updated successfully',
            'table' => 'productpage-table',
        ]);
    }

    public function destroy($id)
    {
        ProductPage::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'productpage deleted successfully',
            'table' => 'productpage-table',
        ]);
    }
}
