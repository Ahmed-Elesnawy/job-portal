<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\TagsDataTable;
use App\Models\Tag;
use Image;
use Storage;
use Toastr;


class TagController extends Controller
{
    public function index(TagsDataTable $tags)
    {
    	return $tags->render('dashboard.tags.index',['title' => trans('dashboard.tags')]);

    } // End of index fn 


    public function create()
    {
    	return view('dashboard.tags.create',['title' => trans('dashboard.add_new_tag')]);

    } // End of create fn


    public function store(Request $request)
    {
    	$data = $request->validate([

            'name'=> ['required','unique:tags'],

        ]);

        $tag = Tag::create($data);

        Toastr::success(trans('dashboard.success_added'));

        if ( $request->action == 'save-edit' )
        {
            return redirect(route('dashboard.tags.edit',$tag->id));
        }

        if ( $request->action == 'save-add' )
        {
            return back();
        }

        return redirect(route('dashboard.tags.index'));

    } // end of store fn


    public function edit(Tag $tag)
    {
        $title = trans('dashboard.edit',['name' => $tag->name]);
        return view('dashboard.tags.edit',compact('tag','title'));

    } // End of edit fn


    public function update(Tag $tag,Request $request)
    {
       $data = $request->validate([

            'name'=> ['required','unique:tags,name,'.$tag->id],
        ]);        

        $tag->update($data);

        Toastr::success(trans('dashboard.success_update'));

        return back();

    } // End of update fn



    public function destroy(Tag $tag)
    {

        $tag->delete();

        Toastr::success(trans('dashboard.success_delete'));

        return redirect(route('dashboard.tags.index'));

    } // End of destroy fn




    public function destroyAll()
    {
        
        $ids = request('item');

        Tag::destroy($ids);

        Toastr::success(trans('dashboard.success_delete'));

        return redirect(route('dashboard.tags.index'));

    } // End Of destroyAll fn

}

