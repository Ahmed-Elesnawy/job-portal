<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\TypesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeRequest;
use App\Models\Type;

use Toastr;


class TypeController extends Controller
{

    
    public function index(TypesDataTable $types)
    {
    	return $types->render('dashboard.types.index',['title' => trans('dashboard.types')]);

    } // End of index fn 


    public function create()
    {
    	return view('dashboard.types.create',['title' => trans('dashboard.add_new_type')]);

    } // End of create fn


    public function store(TypeRequest $request)
    {
    	
        $type = Type::create($request->only('name'));

        Toastr::success(trans('success_added'));

        if ( $request->action == 'save-edit' )
        {
            return redirect(route('dashboard.types.edit',$type->id));
        }

        if ( $request->action == 'save-add' )

        {
            return back();
        }

        return redirect(route('dashboard.types.index'));

    } // end of store fn


    public function edit(Type $type)
    {
        $title = trans('dashboard.edit',['name' => $type->name]);
        return view('dashboard.types.edit',compact('type','title'));

    } // End of edit fn


    public function update(Type $type,TypeRequest $request)
    {
        
        $type->update($request->only('name'));
        Toastr::success(trans('dashboard.success_update'));
        return back();

    } // End of update fn



    public function destroy($id)
    {

        Type::find($id)->delete();
        Toastr::success(trans('dashboard.success_delete'));
        return redirect(route('dashboard.types.index'));

    } // End of destroy fn




    public function destroyAll()
    {

        Type::destroy(request('item'));
        Toastr::success(trans('dashboard.success_delete'));
        return redirect(route('dashboard.types.index'));

    } // End Of destroyAll fn


     

}
