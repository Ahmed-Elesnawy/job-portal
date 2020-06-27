<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data=[];

    public function __construct($data=[])
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('dashboard/auth/emails/reset')
                    ->subject('Reset Admin Account')
                    ->with('data',$this->data);
    }
}
