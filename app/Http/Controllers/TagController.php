<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function jobsShow($slug)
    {
        $tag = Tag::whereSlug($slug)
               ->firstOrFail();

    	$jobs = $tag->jobs()->with('country','type')->paginate(10);

    	return view('frontend.tags.jobs.show',compact('tag','jobs'));
    }

    public function postsShow($slug)
    {
        $tag   = Tag::whereSlug($slug)
                  ->firstOrFail();
                  
        $posts = $tag->posts()->withCount('views')->with('admin')->paginate(5);

        return view('frontend.tags.posts.show',compact('tag','posts'));
    }
}
