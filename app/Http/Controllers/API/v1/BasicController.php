<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\FileUploader;
use App\Models\User;
use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword as MailForgotPassword;
use App\Models\ForgotPassword;
use App\Models\Job;
use App\Models\Promocode;
use App\Models\Slider;
use Illuminate\Support\Facades\Mail;
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
            'promocode' => 'required',
        ]);
        $code = Promocode::where('promocode', $request->promocode)->first();
        $verified = false;
        if ($code) {
            $verified = true;
        }
        return response([
            'verified' => $verified,
            'data' => $code,
        ]);
    }

    public function sendOtpInMail(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);
        $otp = random_int(100000, 999999);
        $data = new ForgotPassword;
        $data->email = $request->email;
        $data->otp = $otp;
        $data->save();
        Mail::to($request->email)->send(new MailForgotPassword($otp));
        return response([
            'success' => true,
            'message' => 'OTP Sent To Your Email',
        ]);
    }
}
