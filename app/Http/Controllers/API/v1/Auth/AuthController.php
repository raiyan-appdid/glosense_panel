<?php

namespace App\Http\Controllers\API\v1\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Models\RegisterOtp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|min:3',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
            'phone' => 'required|unique:users,phone'
        ]);
        if (!empty($request->image)) {
            $image = FileUploader::uploadFile($request->file('image'), 'images/usersimage');
        }
        // return $image;
        $user = User::create([
            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'device_id' => $request->device_id,
            'firebase_uid' => $request->fuid
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }

    public function loginOne(Request $request)
    {
        // return $request->all();
        $t = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request['email'])->first();
        if (!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                'success' => false,
                'message' => 'Bad Credential!'
            ], 401);
        }
        $response = [
            'success' => true,
            'user' => $user,
            'token' => $user->createToken('user')->plainTextToken,
        ];
        return response($response, 200);
    }


    public function loginOneSms(Request $request)
    {
        // return $request->all();
        $t = $request->validate([
            'phone' => 'required|min:10',
        ]);
        $user = User::where('phone', $request->phone)->first();
        if (!$user) {
            $user = new User;
            $user->phone = $request->phone;
            $user->save();
        }

        $updateRegisterOtp = RegisterOtp::where('phone', $request->phone)->update(['is_verified' => 1]);

        $response = [
            'success' => true,
            'user' => $user,
            'token' => $user->createToken('user')->plainTextToken,
        ];
        return response($response, 200);
    }


    public function loginEmail(Request $request)
    {
        $request->validate([
            'google_token' => 'required',
        ]);
        $response = Http::withHeaders([
            "Content-Type" => "application/json",
        ])->get('https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $request->google_token);
        $jsonData = $response->json();


        $user = User::where('email', $jsonData['email'])->first();
        if (!$user) {
            $user = new User;
            $user->email = $jsonData['email'];
            $user->first_name = $jsonData['name'];
            $user->save();
        }

        $response = [
            'success' => true,
            'user' => $user,
            'token' => $user->createToken('user')->plainTextToken,
        ];
        return response($response, 200);
    }

    // public function login(Request $request)
    // {
    //     // return $request->all();
    //     $t = $request->validate([
    //         'token' => 'required|string',
    //         'device_id' => 'required|string',
    //     ]);
    //     return $t;
    //     $auth = app('firebase.auth');
    //     try {
    //         $verifiedIdToken = $auth->verifyIdToken($request->token);
    //     } catch (FailedToVerifyToken $e) {
    //         return response()->json([
    //             'message' => 'The token is invalid: ' . $e->getMessage(),
    //         ], 401);
    //     }
    //     $uid = $verifiedIdToken->claims()->get('sub');
    //     $firebase_user = $auth->getUser($uid);
    //     $phone = substr($firebase_user->phoneNumber, 3);
    //     $user = User::where('fuid', $uid)->first();
    //     $type = 'old';
    //     if (!empty($user)) {
    //         $user->update([
    //             'device_id' => $request->device_id,
    //         ]);
    //     } else {
    //         $user =  User::create([
    //             'phone' => $phone,
    //             'device_id' => $request->device_id,
    //             'fuid' => $uid,
    //         ]);
    //         $type = 'new';
    //     }
    //     return response([
    //         'type' => $type,
    //         'token' => $user->createToken('user')->plainTextToken,
    //     ]);
    // }


    public function test(Request $request)
    {
        return response(['msg' => 'not implemented']);
    }

    public function logout(Request $request)
    {
        request()->user()->currentAccessToken()->delete();
        return response([
            'success' => true,
            'message' => "Logged Out",
        ]);
    }
}
