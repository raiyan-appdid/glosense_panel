<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $otp;
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        $otp = $this->otp;
        return $this->subject('Forgot Password')->view('emails.forgot-password', compact('otp'));
    }
}
