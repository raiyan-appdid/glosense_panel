<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExtraController extends Controller
{

    public function index()
    {
        $extra = Extra::first();
        return view('content.pages.extras', compact('extra'));
    }

    public function store(Request $request)
    {
        if ($request->image) {
            $url =  Storage::disk('do')->putFile('extras', $request->file('image'), 'public');
            $spaceUrl = Storage::disk('do')->url($url);
            $image = $spaceUrl;
            $data = Extra::updateOrCreate(
                ['id' => 1],
                ['heading' => $request->heading, 'image' => $image, 'productt_page_pop_title' => $request->productt_page_pop_title],
            );
        }
        if ($request->product_page_image) {
            $url =  Storage::disk('do')->putFile('extras', $request->file('product_page_image'), 'public');
            $spaceUrl = Storage::disk('do')->url($url);
            $image = $spaceUrl;
            $data = Extra::updateOrCreate(
                ['id' => 1],
                ['heading' => $request->heading, 'product_page_image' => $image, 'productt_page_pop_title' => $request->productt_page_pop_title],
            );
        }
        $data = Extra::updateOrCreate(
            ['id' => 1],
            ['heading' => $request->heading, 'productt_page_pop_title' => $request->productt_page_pop_title],
        );


        return 'saved';
    }
}
