<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\City;
use App\Models\State;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($order)
    {
        $this->data = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $date = Carbon::now()->format('d-m-Y');
        // $delivery_address = json_decode($this->data->shipping_address);
        // $state = State::where('id', $delivery_address->state_id)->first();
        // $city = City::where('id', $delivery_address->city_id)->first();
        $data = $this->data;
        return $this->subject('Your Order Invoice')->view('emails.invoice', compact('data'));
        // return $this->subject('Your Order Invoice')->view('emails.invoice');
    }
}
