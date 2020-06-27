<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelApplicant extends Mailable
{
    use Queueable, SerializesModels;


    protected $seeker;
    protected $company;
    protected $job;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($seeker,$company,$job)
    {
        $this->seeker    = $seeker;
        $this->company = $company;
        $this->job     = $job;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('frontend.emails.cancel_seeker')
               ->with('seeker',$this->seeker)
               ->with('company',$this->company)
               ->with('job',$this->job);
    }
}
