<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WaitingForPayment extends Mailable
{
    use Queueable, SerializesModels;

    protected $price;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($price)
    {
        $this->price = $price;
        $this->subject('Twoja Niedziela - płatność');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.payment')
            ->text('emails.payment')
            ->with([
                'price' => $this->price
            ]);
    }
}
