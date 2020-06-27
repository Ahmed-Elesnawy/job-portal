<?php

namespace App\Jobs;

use App\Mail\ReplyContactMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ReplyContactJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contact;
    protected $reply;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact,$reply)
    {
         $this->contact = $contact;
         $this->reply = $reply;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->contact->email)
        ->send(new ReplyContactMail($this->contact,$this->reply));
    }
}
