<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

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

        $OrdersWithStatusPending = Order::where('status', 'pending')->whereHas('transaction', function ($q) {
            $q->where('payment_gateway', "razorpay live");
        })->get();
        \Log::info($OrdersWithStatusPending);

        foreach ($OrdersWithStatusPending as  $value) {
            if ($value->transaction->razorpay_order_id) {
                \Log::info($value);
            }
        }



        return Command::SUCCESS;
    }
}
