<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function show($slug)
    {
        $skill = Skill::whereSlug($slug)
                 ->firstOrFail();

        $jobs  = $skill->jobs()
                 ->with('type:id,name','country:id,name')
                 ->paginate(10);    

        return view('frontend.skills.show',compact('skill','jobs'));
        
    } // end of show fn 
}
