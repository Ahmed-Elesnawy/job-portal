<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $contact;
    protected $reply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact,$reply)
    {
        $this->contact = $contact;
        $this->reply   = $reply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('dashboard.emails.reply_contact')
                     ->with('contact',$this->contact)
                     ->with('reply',$this->reply);
    }
}
