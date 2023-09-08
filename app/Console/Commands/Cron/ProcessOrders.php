<?php

namespace App\Console\Commands\Cron;

use App\Models\CashFreeOrder;
use Illuminate\Console\Command;
use App\Services\PaymentService;

class ProcessOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:processOrders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $service = new  PaymentService();
        $orders = CashFreeOrder::where('status', 'pending')->get();

        $orders->map(function ($order) use ($service) {
            $service->fetchPayment($order);
        });

        return $this->info('Order Processed Successfully');
    }
}
