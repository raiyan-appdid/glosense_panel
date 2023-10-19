<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\FileUploader;
use App\Models\User;
use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Promocode;
use App\Models\Slider;
use DB;

class BasicController extends Controller
{
    public function getSlider()
    {
        $data = Slider::all();
        return response([
            'sucess' => true,
            'data' => $data,
        ]);
    }

    public function verifyPromoCode(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);
        $code = Promocode::where('promocode', $request->code)->first();
        $verified = false;
        if ($code) {
            $verified = true;
        }
        return response([
            'verified' => $verified,
            'data' => $code,
        ]);
    }
}
