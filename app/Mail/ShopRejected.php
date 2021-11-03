<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShopRejected extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $reason)
    {
        $this->name = $name;
        $this->reason = $reason;

        $this->subject('Twoja Niedziela - sklep został odrzucony');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.shopRejected')
            ->text('emails.shopRejectedPlain')
            ->with([
                'name' => $this->name,
                'reason' => $this->reason,
            ]);
    }
}
