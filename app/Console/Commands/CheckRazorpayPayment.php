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

        $OrdersWithStatusPending = Order::where('status', 'pending')->orderBy('id', 'desc')->with(['transaction'])->first();
        \Log::info($OrdersWithStatusPending);

        // foreach ($OrdersWithStatusPending as $key => $value) {
        //     # code...
        // }



        return Command::SUCCESS;
    }
}
