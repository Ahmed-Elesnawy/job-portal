<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    { 



        return view('welcome',[

        	'jobs'         =>  Job::with('country','type')->latest()->limit(5)->get(),
        	'tags'         =>  Tag::withCount('jobs')->orderBy('jobs_count','desc')->get(),
          'seekers'      =>  User::seekers()->latest()->limit(5)->get(),
          'componies'    =>  User::companies()->withCount('jobs')->orderBy('jobs_count','desc')->limit(4)->get(),
          'testimonials' =>  Testimonial::latest()->limit(5)->get(), 
        ]);
    }
}
