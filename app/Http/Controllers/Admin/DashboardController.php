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

        $paymentService = new PaymentService();
        $paymentService->fetchOrder('0044c44b-0855-47f6-b3dc-8939068f73e8');
        return $paymentService;


        $users = User::withoutadmin()->count();
        $products = Product::count();
        $enquiry = Enquiry::count();
        $promocode = Promocode::count();
        $testimonilas = Testimonial::count();
        return view('content.dashboard', compact('users', 'products', 'enquiry', 'promocode','testimonilas'));
    }
}
