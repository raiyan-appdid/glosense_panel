<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Invoice;
use App\Models\Enquiry;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promocode;
use App\Models\Testimonial;
use App\Models\User;
use App\Services\ccavenue\PaymentService;
use Barryvdh\DomPDF\PDF;
use Http;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public $workingKey;
    public $accessCode;
    public $merchantId;
    public $language;
    public $currency;
    public $version;

    public function home()
    {


        // $this->workingKey = env('CC_WORKING_KEY');
        // $this->accessCode = env('CC_ACCESS_CODE');
        // $this->merchantId = env('CC_MERCHANT_ID');
        // $this->language = "EN";
        // $this->currency = "INR";
        // $this->version = 1.1;

        // $merchant_json_data = array(
        //     'order_no' => 'ceb82bd2-a62a-453c-a5d3-bef0230f26d0', //your app's internal order no
        //     'reference_no' => '113062410532' //ccavenue tracking no
        // );

        // $merchant_data = json_encode($merchant_json_data);
        // $encrypted_data = encrypt($merchant_data, $this->workingKey);

        // $response = Http::asForm()->withHeaders([
        //     'Content-Type' => 'application/x-www-form-urlencoded',
        // ])->post('https://api.ccavenue.com/apis/servlet/DoWebTrans', [
        //     'enc_request' => $encrypted_data,
        //     'access_code' => $this->accessCode,
        //     'command' => 'orderStatusTracker',
        //     'request_type' => 'JSON',
        //     'response_type' => 'JSON',
        //     'version' => '1.3'
        // ])->body();

        // dd($response);








        // $command = "orderStatusTracker";
        // $final_data = "request_type=JSON&access_code=" . $this->accessCode . "&command=" . $command . "&response_type=JSON&version=" . $this->version;

        // // return $final_data;


        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, "https://api.ccavenue.com/apis/servlet/DoWebTrans");
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_VERBOSE, 1);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);

        // $result = curl_exec($ch);
        // curl_close($ch);

        // $information = explode('&', $result);
        // $dataSize = sizeof($information);
        // $status1 = explode('=', $information[0]);
        // $status2 = explode('=', $information[1]);
        // // $status3 = explode('=', $information[2]);
        // if ($status1[1] == '1') {
        //     return [$information, $status1, $status2];
        //     $recorddata = $status2[1];
        //     return $recorddata . " Error Code:" . $status2[1];
        // } else {
        //     // $status = self::decrypt($status2[1], $this->working_key);
        //     return $status2;
        // }


        // $data = new PaymentService;
        // $data->fetchOrder("3f8fe7df-a4b7-4c5e-8550-652fb1ebe95e");
        // return $data;

        Mail::to("raiyanmemon7860@gmail.com")->send(new Invoice('648'));


        $updateOrder = Order::where('id', 648)->with(['transaction'])->first();
        
        $pdf = \PDF::loadView('emails.invoice', ['updateOrder' => $updateOrder]);
        return $pdf->download('invoice.pdf');

        $users = User::withoutadmin()->count();
        $products = Product::count();
        $enquiry = Enquiry::count();
        $promocode = Promocode::count();
        $testimonilas = Testimonial::count();
        return view('content.dashboard', compact('users', 'products', 'enquiry', 'promocode', 'testimonilas'));
    }
}
