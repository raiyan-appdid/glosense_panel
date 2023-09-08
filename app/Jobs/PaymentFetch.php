<?php

namespace App\Jobs;

use App\Models\CashFreeOrder;
use App\Models\User;
use App\Services\PaymentService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class PaymentFetch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $cashfreeOrder;
    public $user;
    public function __construct(CashFreeOrder $cashfreeOrder, User $user)
    {
        $this->cashfreeOrder = $cashfreeOrder;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $service = new  PaymentService();

        $service->fetchPayment($this->cashfreeOrder, $this->user);
        \Log::info('Job ran');
    }
}
