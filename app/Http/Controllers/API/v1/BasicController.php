<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\FileUploader;
use App\Models\User;
use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword as MailForgotPassword;
use App\Models\CcAvenueTransaction;
use App\Models\ForgotPassword;
use App\Models\Job;
use App\Models\Order;
use App\Models\Promocode;
use App\Models\Slider;
use App\Services\ShipRocket\GenerateTokenService;
use Illuminate\Support\Facades\Mail;
use DB;
use Hash;
use Illuminate\Support\Facades\Http;

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
        \Log::info($data);
        Mail::to($request->email)->send(new MailForgotPassword($data->otp));
        return response([
            'success' => true,
            'message' => 'OTP Sent To Your Email',
        ]);
    }

    public function verifyOtpAndChangePassword(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
        ]);

        $checkOtp = ForgotPassword::where('email', $request->email)->where('is_verified', 0)->where('otp', $request->otp)->first();
        if ($checkOtp) {
            if ($checkOtp->is_verified == 0) {
                $user = User::where('email', $request->email)->first();
                $user->password = Hash::make($request->password);
                $user->save();
                $checkOtp->is_verified = 1;
                $checkOtp->save();
            } else {
                return response([
                    'success' => false,
                    'message' => 'Invalid Otp',
                ]);
            }
            return response([
                'success' => true,
                'message' => 'Password Updated Successfully',
            ]);
        } else {
            return response([
                'success' => false,
                'message' => 'Invalid Otp',
            ]);
        }
    }

    public function getOrderById(Request $request)
    {
        $token = new GenerateTokenService;
        $token = $token->getToken();

        $orderData = Order::where('user_id', $request->user()->id)->where('shiprocket_order_id', '!=', null)->get();


        // https://apiv2.shiprocket.in/v1/external/orders/show/444021491

        if (count($orderData) > 0) {
            $response = Http::withHeaders([
                'Authorization' => "Bearer $token",
                "Content-Type" => "application/json",
            ])->get('https://apiv2.shiprocket.in/v1/external/orders/show/' . $orderData[0]->shiprocket_order_id);
            $res = $response->json();

            return response([
                'success' => true,
                'token' => $token,
                'response' => $res,
                'fetch_order_code' => $response->status(),
                'order_data' => $orderData[0],
            ]);
        }
        return response([
            'success' => false,
            'fetch_order_code' => 404,
        ]);
    }
}
