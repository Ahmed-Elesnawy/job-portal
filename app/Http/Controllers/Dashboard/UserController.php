<?php

namespace App\Http\Controllers\Dashboard;

use Image;
use Toastr;
use App\Models\User;
use App\DataTables\UsersDataTable;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
    * Render datatable data 
    * @param object $users
    * @return void
    */
    
    public function index(UsersDataTable $users)
    {
       
    	return $users->render('dashboard.users.index',['title' => trans('dashboard.users')]);

    } 

    /**
    * Render create view 
    * @return object 
    */

    public function create()
    {
    	return view('dashboard.users.create',['title' => trans('dashboard.add_new_user')]);

    }

    /**
    * Store given data in db 
    * @param object $request
    * @return void
    */
    public function store(UserRequest $request)
    {       
        $user = User::create($request->all());

        Toastr::success(trans('dashboard.success_added'));

        if ( $request->action == 'save-edit' )
        {
            return redirect(route('dashboard.users.edit',$user->id));
        }

        if ( $request->action == 'save-add' )

        {
            return back();
        }

        return redirect(route('dashboard.users.index'));

    } // end of store fn


    public function edit(User $user)
    {
        $title = trans('dashboard.edit',['name' => $user->name]);
        return view('dashboard.users.edit',compact('user','title'));

    } // End of edit fn


    public function update(User $user,UserRequest $request)
    {

        $data = $request->except(['image']);

        if ( $request->hasFile('image') )
        {            
            $data['image'] = upload('image','users',48,48,$user->image);
        }

        $user->update($data);

        if ( $user->hasCompanyProfile )
		{

            $user->profile()->update([

                'size'           => request('size'),
                'specialized_in' => request('specialized_in'),
                'phone'          => request('phone')

            ]);
       }
       

       if ( $user->hasSeekerProfile )
		{
            $data = [

                'fullname'   => $request->fullname,
                'mobile'     => $request->mobile,
                'position'   => $request->position,
                'experience' => $request->experience,
            ];

            if ( $request->hasFile('cv') )
            {
                $oldCv = $user->profile->cv;
                Storage::has($oldCv) ? Storage::delete($oldCv) : '';
                $data['cv'] = $request->cv->store('cvs');
            }

            $user->profile()->update($data);
		}


        Toastr::success(trans('dashboard.success_updated'));

        return back();

    } // End of update fn



    public function destroy(User $user)
    {
        $user->delete();
        Toastr::success(trans('dashboard.success_delete'));
        return redirect(route('dashboard.users.index'));
        
    } // End of destroy fn




    public function destroyAll()
    {
        User::destroy(request('item'));
        Toastr::success(trans('dashboard.success_delete'));
        return redirect(route('dashboard.users.index'));

    } // End Of destroyAll fn


}
