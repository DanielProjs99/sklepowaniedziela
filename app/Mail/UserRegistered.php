<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    protected $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($activationCode)
    {
        $this->subject('Rejestracja konta Twoja Niedziela');
        
        $this->link = action('Store\Auth\RegisterController@activation', ['activation' => urlencode($activationCode)]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.registration')
                    ->text('emails.registrationPlain')
                    ->with([
                        'link' => $this->link
                    ]);
    }
}
