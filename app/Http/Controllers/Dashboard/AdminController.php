<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Services\AdminService;
use Image;
use Storage;
use Toastr;

class AdminController extends Controller
{
    

    public function index(AdminDataTable $admins)
    {
        return $admins->render('dashboard.admins.index', ['title' => trans('dashboard.admins')]);

    } // End of index fn


    public function create()
    {
        return view('dashboard.admins.create', ['title' => trans('dashboard.add_new_admin')]);
    } // End of create fn


    public function store(AdminRequest $request)
    {
        $data = $request->except(['image']);

        if ( $request->hasFile('image') )
        {
            $data['image'] = upload('image','admins',60,60);
        }

        $admin = Admin::create($data);

        Toastr::success(trans('dashboard.success_added'));

        if ($request->action == 'save-edit') {

            return redirect(route('dashboard.admins.edit', $admin->id));
        }

        if ($request->action == 'save-add') {
            return back();
        }

        return redirect(route('dashboard.admins.index'));

    } // end of store fn


    public function edit(Admin $admin)
    {
        $title = trans('dashboard.edit', ['name' => $admin->name]);
        return view('dashboard.admins.edit', compact('admin', 'title'));

    } // End of edit fn


    public function update(Admin $admin, AdminRequest $request)
    {
       $data = $request->except(['image']);

        if ( $request->hasFile('image') )
        {
            $data['image'] = upload('image','admins',60,60,$admin->image);
        }

        $admin->update($data);

        Toastr::success('Updated!');

        return back();

    } // End of update fn



    public function destroy(Admin $admin)
    {
        $admin->delete();
        Toastr::success('deleted!');
        return redirect(route('dashboard.admins.index'));

    } // End of destroy fn




    public function destroyAll()
    {
        Admin::destroy(request('item'));
        Toastr::success('deleted!');
        return redirect(route('dashboard.admins.index'));
        
    } // End Of destroyAll fn
}
