<?php

namespace App\Http\Controllers\Admin;

use Hash;
use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(ProductDataTable $table)
    {
        $pageConfigs = ['has_table' => true,];
        // $table->with('id', 1);
        return $table->render('content.tables.product.products', compact('pageConfigs'));
    }

    public function create()
    {
        $units = Unit::where('status', 'active')->get();
        return view('content.tables.product.add', compact('units'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'video_link' => 'nullable',
            'price' => 'required|numeric',
            'discounted_price' => 'required|numeric',
            'measurement' => 'required|numeric',
            'unit_id' => 'required|exists:units,id',
            'stock' => 'required|numeric',
            'in_stock' => 'nullable',
            'is_special' => 'nullable',
            'is_best_seller' => 'nullable',
            'manufacturer' => 'required',
            'made_in' => 'required',
            'is_returnable' => 'nullable',
            'is_cancellable' => 'nullable',
            'is_cod' => 'nullable',
            'allowed_quantity' => 'required|numeric',
            'how_to_take' => 'nullable',
            'short_description' => 'required',
            'description' => 'required',
            'product_detail' => 'required',
            'images' => 'required|array|min:2',
            'images.*' => 'mimes:png,jpg,jpeg,svg,webp',
        ]);
        // return $request->all();

        DB::beginTransaction();
        $product = Product::create([
            'title' => $request->title,
            'video_link' => $request->video_link,
            'slug' => Str::slug($request->title),
            'price' => $request->price,
            'discounted_price' => $request->discounted_price,
            'measurement' => $request->measurement,
            'unit_id' => $request->unit_id,
            'stock' => $request->stock,
            'in_stock' => ($request->in_stock == 'on') ? 'yes' : 'no',
            'is_special' => ($request->is_special == 'on') ? 'yes' : 'no',
            'is_best_seller' => ($request->is_best_seller == 'on') ? 'yes' : 'no',
            'manufacturer' => $request->manufacturer,
            'made_in' => $request->made_in,
            'is_returnable' => ($request->is_returnable == 'on') ? 'yes' : 'no',
            'is_cancellable' => ($request->is_cancellable == 'on') ? 'yes' : 'no',
            'is_cod' => ($request->is_cod == 'on') ? 'yes' : 'no',
            'allowed_quantity' => $request->allowed_quantity,
            'how_to_take' => $request->how_to_take,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'product_detail' => $request->product_detail,
        ]);

        $data = [];
        foreach ($request->images as $key => $image) {
            $data[] = [
                'product_id' => $product->id,
                'image' => FileUploader::uploadFile($image, 'images/product-image'),
                'created_at' => now(),
            ];
        }
        ProductImage::insert($data);
        DB::commit();

        return response([
            'header' => 'Success!',
            'message' => 'Product created successfully!',
            'table' => 'product-table',
        ]);
    }
    public function edit($id)
    {        
        $product = Product::with(['images', 'unit'])->findOrFail($id);
        $units = Unit::where('status', 'active')->get();
        return view('content.forms.edit-product', compact('product', 'units'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'title' => 'required',
            'video_link' => 'nullable',
            'price' => 'required|numeric',
            'discounted_price' => 'required|numeric',
            'measurement' => 'required|numeric',
            'unit_id' => 'required|exists:units,id',
            'stock' => 'required|numeric',
            'in_stock' => 'nullable',
            'is_special' => 'nullable',
            'is_best_seller' => 'nullable',
            'manufacturer' => 'required',
            'made_in' => 'required',
            'is_returnable' => 'nullable',
            'is_cancellable' => 'nullable',
            'is_cod' => 'nullable',
            'allowed_quantity' => 'required|numeric',
            'how_to_take' => 'nullable',
            'short_description' => 'required',
            'description' => 'required',
            'product_detail' => 'required',
            'images' => 'nullable|array',
            'images.*' => 'mimes:png,jpg,jpeg,svg,webp',
        ]);
        // return  $request->all();

        $product = Product::findOrFail($request->id);
        DB::beginTransaction();
        $product->update([
            'title' => $request->title,
            'video_link' => $request->video_link,
            'slug' => Str::slug($request->title),
            'price' => $request->price,
            'discounted_price' => $request->discounted_price,
            'measurement' => $request->measurement,
            'unit_id' => $request->unit_id,
            'stock' => $request->stock,
            'in_stock' => ($request->in_stock == 'on') ? 'yes' : 'no',
            'is_special' => ($request->is_special == 'on') ? 'yes' : 'no',
            'is_best_seller' => ($request->is_best_seller == 'on') ? 'yes' : 'no',
            'manufacturer' => $request->manufacturer,
            'made_in' => $request->made_in,
            'is_returnable' => ($request->is_returnable == 'on') ? 'yes' : 'no',
            'is_cancellable' => ($request->is_cancellable == 'on') ? 'yes' : 'no',
            'is_cod' => ($request->is_cod == 'on') ? 'yes' : 'no',
            'allowed_quantity' => $request->allowed_quantity,
            'how_to_take' => $request->how_to_take,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'product_detail' => $request->product_detail,
        ]);
        if ($request->has('images')) {
            foreach ($request->images as $key => $value) {
                if (in_array($key, $request->images_id)) {
                    ProductImage::find($key)->update([
                        'image' => FileUploader::uploadFile($value, 'images/product-image'),
                    ]);
                } else {
                    ProductImage::create([
                        'image' => FileUploader::uploadFile($value, 'images/product-image'),
                        'product_id' => $product->id,
                    ]);
                }
            }
        }
        DB::commit();

        return response([
            'message' => 'Product detail updated Successfully!',
            'table' => 'product-table',
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:products,id',
            'status' => 'required|in:active,blocked',
        ]);

        Product::findOrFail($request->id)->update(['status' => $request->status]);

        return response([
            'message' => 'product status updated successfully',
            'table' => 'product-table',
        ]);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->update(['status' => 'blocked']);
        return response([
            'header' => 'Deleted!',
            'message' => 'product deleted successfully',
            'table' => 'product-table',
        ]);
    }

    public function imageDestroy($id)
    {
        ProductImage::findOrFail($id)->delete();
        return response([
            'header' => 'Deleted!',
            'message' => 'product image deleted successfully',
            'table' => 'product-table',
        ]);
    }


    public function inStock(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:products,id',
        ]);
        $product = Product::findOrFail($request->id);
        if ($product->in_stock == 'yes') {
            $product->in_stock = 'no';
        } else {
            $product->in_stock = 'yes';
        }
        $product->save();
        return response([
            'message' => 'In stock updated successfully',
            'table' => 'product-table',
        ]);
    }
    public function isSpecial(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:products,id',
        ]);
        $product = Product::findOrFail($request->id);
        if ($product->is_special == 'yes') {
            $product->is_special = 'no';
        } else {
            $product->is_special = 'yes';
        }
        $product->save();
        return response([
            'message' => 'Is special updated successfully',
            'table' => 'product-table',
        ]);
    }
    public function isBestSeller(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:products,id',
        ]);
        $product = Product::findOrFail($request->id);
        if ($product->is_best_seller == 'yes') {
            $product->is_best_seller = 'no';
        } else {
            $product->is_best_seller = 'yes';
        }
        $product->save();
        return response([
            'message' => 'Is best seller updated successfully',
            'table' => 'product-table',
        ]);
    }
    public function isReturnable(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:products,id',
        ]);
        $product = Product::findOrFail($request->id);
        if ($product->is_returnable == 'yes') {
            $product->is_returnable = 'no';
        } else {
            $product->is_returnable = 'yes';
        }
        $product->save();
        return response([
            'message' => 'Is returnable updated successfully',
            'table' => 'product-table',
        ]);
    }
    public function isCancellable(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:products,id',
        ]);
        $product = Product::findOrFail($request->id);
        if ($product->is_cancellable == 'yes') {
            $product->is_cancellable = 'no';
        } else {
            $product->is_cancellable = 'yes';
        }
        $product->save();
        return response([
            'message' => 'Is cancellable updated successfully',
            'table' => 'product-table',
        ]);
    }
    public function isCod(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:products,id',
        ]);
        $product = Product::findOrFail($request->id);
        if ($product->is_cod == 'yes') {
            $product->is_cod = 'no';
        } else {
            $product->is_cod = 'yes';
        }
        $product->save();
        return response([
            'message' => 'Is cod updated successfully',
            'table' => 'product-table',
        ]);
    }
    public function isCombo(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:products,id',
        ]);
        $product = Product::findOrFail($request->id);
        if ($product->is_combo == 'yes') {
            $product->is_combo = 'no';
        } else {
            $product->is_combo = 'yes';
        }
        $product->save();
        return response([
            'message' => 'Is combo updated successfully',
            'table' => 'product-table',
        ]);
    }
}
