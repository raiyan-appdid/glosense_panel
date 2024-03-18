<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPage;

class ProductPageController extends Controller
{
    public function getText()
    {
        $data = ProductPage::first();
        return response([
            'success' => true,
            'data' => $data,
        ]);
    }
}
