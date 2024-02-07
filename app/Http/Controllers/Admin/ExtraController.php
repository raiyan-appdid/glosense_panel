<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use Illuminate\Http\Request;

class ExtraController extends Controller
{

    public function index()
    {
        $extra = Extra::first();
        return view('content.pages.extras', compact('extra'));
    }

    public function store(Request $request)
    {
        $data = Extra::updateOrCreate(
            ['id' => 1],
            ['heading' => $request->heading],
        );
        return 'saved';
    }
}
