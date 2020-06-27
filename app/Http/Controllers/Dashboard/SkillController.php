<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SkillsDataTable;
use App\Models\Skill;
use Image;
use Storage;
use Toastr;


class SkillController extends Controller
{
    public function index(SkillsDataTable $skills)
    {
    	return $skills->render('dashboard.skills.index',['title' => trans('dashboard.skills')]);

    } // End of index fn 


    public function create()
    {
    	return view('dashboard.skills.create',['title' => trans('dashboard.add_new_skill')]);

    } // End of create fn


    public function store(Request $request)
    {
    	$data = $request->validate([

    		'name'=> ['required','unique:skills'],

    	]);


    	$skill = Skill::create($data);
        Toastr::success(trans('dashboard.success_added'));
        
        if ( $request->action == 'save-edit' )
        {
            return redirect(route('dashboard.skills.edit',$skill->id));
        }

        if ( $request->action == 'save-add' )
        {
            return back();
        }

        return redirect(route('dashboard.skills.index'));

    } // end of store fn


    public function edit(Skill $skill)
    {
        $title = trans('dashboard.edit',['name' => $skill->name]);
        return view('dashboard.skills.edit',compact('skill','title'));

    } // End of edit fn


    public function update(Skill $skill,Request $request)
    {
        $data = $request->validate([

            'name'=> ['required','unique:skills,name,'.$skill->id],
        ]);

        $skill->update($data);

        Toastr::success(trans('dashboard.success_update'));

        return back();

    } // End of update fn



    public function destroy(Skill $skill)
    {

        $skill->delete();

        Toastr::success(trans('dashboard.success_delete'));

        return redirect(route('dashboard.skills.index'));

    } // End of destroy fn




    public function destroyAll()
    {
        
        Skill::destroy(request('item'));

        Toastr::success(trans('dashboard.success_delete'));

        return redirect(route('dashboard.skills.index'));

    } // End Of destroyAll fn




   


     

}
