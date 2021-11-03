<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($resetToken)
    {
        $this->subject('Reset hasła Twoja Niedziela');
        
        $this->link = action('Store\Auth\ForgotPasswordController@changePassword', ['token' => urlencode($resetToken)]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.forgotPassword')
            ->text('emails.forgotPasswordPlain')
            ->with([
                'link' => $this->link
            ]);
    }
}
