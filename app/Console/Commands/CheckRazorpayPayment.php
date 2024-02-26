<?php

namespace App\Console\Commands;

use App\Models\CcAvenueTransaction;
use App\Models\Order;
use App\Services\RazorPayIntegration;
use App\Services\ShipRocket\CreateOrderService;
use App\Services\ShipRocket\GenerateTokenService;
use Illuminate\Console\Command;
use App\Mail\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CheckRazorpayPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command checks the payment on the pending and if it is successfull it creates the order to the ship rocket';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $sevenDaysAgo = Carbon::now()->subDays(7);
        $OrdersWithStatusPending = Order::where('status', 'pending')
            ->where('created_at', '>=', $sevenDaysAgo)
            ->orderBy('id', 'desc')
            ->with('transaction', function ($q) {
                $q->where('payment_gateway', 'razorpay live');
            })
            ->where('shiprocket_order_id', null)
            ->count();
        \Log::info($OrdersWithStatusPending);

        // foreach ($OrdersWithStatusPending as  $OrdersWithStatusPending) {
        // if ($OrdersWithStatusPending->transaction?->razorpay_order_id ?? "" != "") {

        //     $checkPayment = RazorPayIntegration::fetchOrder($OrdersWithStatusPending->transaction->razorpay_order_id);
        //     if ($checkPayment['success']) {
        //         $status = $checkPayment['status'];
        //         $razorpayOrderData = CcAvenueTransaction::where('razorpay_order_id', $OrdersWithStatusPending->transaction->razorpay_order_id)->first();
        //         $razorpayOrderData->status = $status;
        //         $razorpayOrderData->save();
        //         if ($status == 'paid' || $status == 'captured') {
        //             $OrdersWithStatusPending->status = "PAID";
        //             $transactionStatus = CcAvenueTransaction::where('id', $OrdersWithStatusPending->transaction->id)->with(['order'])->first();
        //             $transactionStatus->status = 'PAID';
        //             $transactionStatus->save();

        //             $token = new GenerateTokenService;
        //             $token = $token->getToken();
        //             $shiprocketOrder = new CreateOrderService;
        //             $response = $shiprocketOrder->create($token, $OrdersWithStatusPending);
        //             $OrdersWithStatusPending->shiprocket_order_id = $response['order_id'];
        //             $OrdersWithStatusPending->shipment_id = $response['shipment_id'];
        //             $OrdersWithStatusPending->save();
        //             Mail::to($OrdersWithStatusPending->email)->send(new Invoice($transactionStatus->order->id));
        //         }
        //     }
        // }
        // }



        return Command::SUCCESS;
    }
}
