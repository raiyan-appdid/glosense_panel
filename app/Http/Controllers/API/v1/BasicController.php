<?php

namespace App\Http\Controllers\API\v1;

use App\Helpers\FileUploader;
use App\Models\User;
use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword as MailForgotPassword;
use App\Models\Analytic;
use App\Models\Blog;
use App\Models\CcAvenueTransaction;
use App\Models\Extra;
use App\Models\ForgotPassword;
use App\Models\Job;
use App\Models\Order;
use App\Models\ProductPageImage;
use App\Models\Promocode;
use App\Models\ProvidedEmail;
use App\Models\RegisterOtp;
use App\Models\Review;
use App\Models\Slider;
use App\Services\ShipRocket\GenerateTokenService;
use App\Services\SmsIntegration;
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

    public function getAllReviews()
    {
        $data = Review::where('status', 'active')->simplePaginate(5);
        $reviewCount = Review::where('status', 'active')->count();
        $oneStar = Review::where('star', 1)->count();
        $twoStar = Review::where('star', 2)->count();
        $threeStar = Review::where('star', 3)->count();
        $fourStar = Review::where('star', 4)->count();
        $fiveStar = Review::where('star', 5)->count();
        return response([
            'success' => true,
            'data' => $data,
            'oneStar' => $oneStar,
            'twoStar' => $twoStar,
            'threeStar' => $threeStar,
            'fourStar' => $fourStar,
            'fiveStar' => $fiveStar,
            'reviewCount' => $reviewCount,
        ]);
    }

    public function sms(Request $request)
    {
        $request->validate([
            'phone' => 'required|min:10',
        ]);

        $otp = random_int(100000, 999999);
        $data = new RegisterOtp;
        $data->phone = $request->phone;
        $data->otp = $otp;
        $data->save();

        $message = "Glosense: Your OTP is " . $data->otp . ". Use it to log in securely. Do not share. Regards, Glosense Lifecare PVT LTD";
        $sms = SmsIntegration::action($request->phone, $message);
        if ($sms['status']) {
            return response([
                'success' => true,
                'sent' => true,
                'message' => 'OTP Sent To Your Number',
            ]);
        }
        return response([
            'success' => true,
            'sent' => false,
            'message' => 'Issue while sending OTP to your number',
        ]);
    }

    public function verifySmsOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'otp' => 'required',
        ]);

        $data = RegisterOtp::where('phone', $request->phone)->where('otp', $request->otp)->where('is_verified', 0)->first();
        if ($data) {
            return response([
                'success' => true,
                'valid' => true,
            ]);
        }
        return response([
            'success' => true,
            'valid' => false,
        ]);
    }

    public function storeReview(Request $request)
    {
        $data = new Review;
        $data->title = $request->user()->first_name;
        $data->description = $request->review;
        $data->star = $request->star;
        $data->user_id = $request->user()->id;
        $data->type = "website";
        $data->status = "blocked";
        $data->save();
        return response([
            'message' => 'Review Stored',
            'table' => 'review-table',
        ]);
    }

    public function storeAnanomyousReview(Request $request)
    {
        $data = new Review;
        $data->title = $request->name;
        $data->description = $request->description;
        $data->star = $request->rating;
        $data->type = "website";
        $data->status = "blocked";
        $data->save();
        return response([
            'message' => 'Review Stored',
            'table' => 'review-table',
        ]);
    }

    public function getHeading()
    {
        $data = Extra::first();
        return response([
            'success' => true,
            'heading' => $data->heading,
            'image' => $data->image,
        ]);
    }

    public function storeEmail(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
        $data = new ProvidedEmail;
        $data->email = $request->email;
        $data->save();
        return response([
            'success' => true,
            'message' => 'stored'
        ]);
    }

    public function storeAnalytics(Request $request)
    {
        $data = new Analytic;
        $data->user_id = $request->user()->id;
        $data->for = 'buy now';
        $data->created_at = now();
        $data->save();
        return response([
            'success' => true,
            'message' => 'stored',
        ]);
    }

    public function productImage()
    {
        $data = ProductPageImage::active()->orderBy('rank', 'asc')->get();
        return response([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function allBlogs()
    {
        $data = Blog::active()->get();
        return response([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function blogDetails(Request $request)
    {
        $request->validate([
            'blog_id' => 'required',
        ]);
        $data = Blog::where('id', $request->blog_id)->first();
        return response([
            'success' => true,
            'data' => $data,
        ]);
    }
}
