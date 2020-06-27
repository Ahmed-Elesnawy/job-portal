<?php

namespace App\Observers;

use App\Models\Job;
use App\Services\JobService;

class JobObserver
{

	

    public function creating($job)
    {
       $job->slug = create_unique_slug($job->title,Job::class);
    }

    public function updating($job)
    {
    	$job->slug = create_unique_slug($job->title,Job::class);
    }


    public function deleted($job)
    {
    	check_file($job->banner);
    	$job->tags()->detach();
    }
}
