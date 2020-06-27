<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\CancelApplicant;


class CanceldEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $seeker;
    protected $company;
    protected $listing;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($seeker,$company,$listing)
    {
        $this->seeker = $seeker;
        $this->company = $company;
        $this->listing = $listing;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = new CancelApplicant($this->seeker,$this->company,$this->listing);
        Mail::to($this->seeker->email)->send($mail);
    }
}
