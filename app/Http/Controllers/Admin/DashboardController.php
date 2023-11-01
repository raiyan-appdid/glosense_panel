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

        $data = new PaymentService;
        $data->fetchOrder("3f8fe7df-a4b7-4c5e-8550-652fb1ebe95e");
        return $data;

        $users = User::withoutadmin()->count();
        $products = Product::count();
        $enquiry = Enquiry::count();
        $promocode = Promocode::count();
        $testimonilas = Testimonial::count();
        return view('content.dashboard', compact('users', 'products', 'enquiry', 'promocode','testimonilas'));
    }
}
