<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class JobApplyed extends Notification
{
    protected $job;
    protected $seeker;

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($job, $seeker)
    {
        $this->job    = $job;
        $this->seeker = $seeker;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [

            'seeker_name' => $this->seeker->name,
            'seeker_url'  => $this->seeker->seekerShow,
            'job_title'   => $this->job->title,
            'job_url'     => $this->job->showUrl
            
        ];
    }

    
}
