<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\JobApplyed;
use Illuminate\Support\Facades\Notification;
use Toastr;
class SeekerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:seeker'])->only([
            'saveJob','applyJob','savedJobs','appliedJobs','destroySaved','destroyApplied'
        ]);

    }

    public function index()
    {
    	$seekers = User::seekers()->latest()->paginate(12);
    	return view('frontend.seekers.index',compact('seekers'));
    }


    public function show($id,$slug)
    {
    	$seeker = User::findOrFail($id);
    	return view('frontend.seekers.show',compact('seeker'));
    }


     public function saveJob($slug)
     {
        if (request()->ajax()) {

            $job  = Job::whereSlug($slug)
                    ->firstOrFail();

            $user = auth()->user();

            $user->savedJobs()->toggle($job);


            if ($user->hasSavedJob($job)) {
                
                return response(['added'=> true], 200);
            }

            return response(['removed' => true], 200);
        }

        abort(404);
        
    } // end of save Job


    public function applyJob($slug)
    {
        

        $job = Job::whereSlug($slug)
                   ->firstOrFail();

        if ( !user()->hasAppliedJob($job) )
        {
            user()->appliedJobs()->attach($job);
            Notification::send($job->user, new JobApplyed($job, user()));

        } else {

            Toastr::warning('You applied in this job');
            return back();

        }

        Toastr::success('You applied on this job');

        return back();

    






       /* if (request()->ajax()) {

            $job  = Job::whereSlug($slug)
                    ->firstOrFail();

            $user = auth()->user();

            $user->appliedJobs()->toggle($job);

            if ($user->hasAppliedJob($job)) {

                Notification::send($job->user, new JobApplyed($job, $user));
                
                return response(['added'=> true], 200);
            }

            return response(['removed' => true], 200);
        }

        abort(404);*/
    } 


    public function savedJobs()
    {
        $jobs = auth()->user()->savedJobs()->with('user')->latest()->paginate(5);

        return view('frontend.seekers.saved', compact('jobs'));
    }

    public function destroySaved($slug)
    {
        if ( request()->ajax()){

            $job  = Job::whereSlug($slug)
                    ->firstOrFail();

            auth()->user()->savedJobs()->detach($job->id);
        }
    }


    public function AppliedJobs()
    {
        $jobs = auth()->user()->appliedJobs()->with('user')->latest()->paginate(5);

        return view('frontend.seekers.applied', compact('jobs'));

    }

    public function destroyApplied($slug)
    {
        if ( request()->ajax() )
        {
            $job  = Job::whereSlug($slug)
                    ->firstOrFail();


            auth()->user()->appliedJobs()->detach($job->id);
        }

        return response('done');
    }
}