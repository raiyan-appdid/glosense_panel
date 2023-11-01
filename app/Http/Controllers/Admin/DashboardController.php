<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Invoice;
use App\Models\Enquiry;
use App\Models\Product;
use App\Models\Promocode;
use App\Models\Testimonial;
use App\Models\User;
use App\Services\ccavenue\PaymentService;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{

    public function home()
    {


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://login.ccavenue.com/apis/servlet/DoWebTrans");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);

        // curl_setopt_array($ch, [
        //     CURLOPT_URL => "https://login.ccavenue.com/apis/servlet/DoWebTrans",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_HTTPHEADER => [
        //         "Accept: application/json"
        //     ],
        // ]);

        $result = curl_exec($ch);
        curl_close($ch);

        $information = explode('&', $result);
        $dataSize = sizeof($information);
        $status1 = explode('=', $information[0]);
        $status2 = explode('=', $information[1]);
        // $status3 = explode('=', $information[2]);
        if ($status1[1] == '1') {
            $recorddata = $status2[1];
            return $recorddata . " Error Code:" . $status2[1];
        } else {
            // $status = self::decrypt($status2[1], $this->working_key);
            return $status2;
        }


        $data = new PaymentService;
        $data->fetchOrder("3f8fe7df-a4b7-4c5e-8550-652fb1ebe95e");
        return $data;

        $users = User::withoutadmin()->count();
        $products = Product::count();
        $enquiry = Enquiry::count();
        $promocode = Promocode::count();
        $testimonilas = Testimonial::count();
        return view('content.dashboard', compact('users', 'products', 'enquiry', 'promocode', 'testimonilas'));
    }
}
