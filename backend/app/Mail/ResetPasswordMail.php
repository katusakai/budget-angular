<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $frontendUrl = request()->getScheme() . '://' . request()->getHost() . ':' . env('WEB_PROD_PORT');

        return $this->markdown('Email.passwordReset')->with([
            'url' => $frontendUrl . '/response-password-reset?token='. $this->token,
        ]);
    }
}
