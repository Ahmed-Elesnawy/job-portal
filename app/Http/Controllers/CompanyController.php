<?php

namespace App\Http\Controllers;

use App\Role;
use App\Models\Job;
use App\Permission;
use App\Models\User;
use App\Jobs\CanceldEmails;
use Illuminate\Http\Request;
use Toastr;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','role:company'])->except(['index','show']);
    }

	public function index()
	{
        
        $companies = User::companies()->latest()->withCount('jobs')->paginate(12);
        
    	return view('frontend.companies.index',compact('companies'));

    } // end of index fn
    
    

    public function createUserPage()
    {
        return view('frontend.companies.users.create',[

            'permissions' =>  Permission::where('name','=','create_jobs')
                                        ->pluck('display_name','id'),

        ]);
    }
    

    public function storeUser(Request $request)
    {



       $data =  $request->validate([

            'name'        => 'required',
            'email'       => 'required|email|unique:users',
            'password'    => 'required|min:4',
            'role'        => 'required|unique:roles,name',
            'permissions' => 'required',

        ]);

        $user = User::create([
            'name'       => $request->name,
            'password'   => $request->password,
            'email'      => $request->email,
            'company_id' => user()->id
        ]);

        $role               = new Role();
        $role->name         = $request->role;
        $role->display_name = ucfirst($request->role);
        $role->save();


        $user->attachRole($role);
        $user->syncPermissions($request->permissions);

        Toastr::success('New User Added Succesfully');

        return back();


    }

    public function users()
    {
        return view('frontend.companies.users.index',[

            'admins' => user()->admins()->paginate(5),
            

        ]);
    }


    public function editUserPage(User $user)
    {
        return view('frontend.companies.users.edit',[
            'admin' => $user ,
            'permissions' => Permission::where('name','=','create_jobs')
                                        ->pluck('display_name','id'),
        ]);
    }


    public function updateUser(User $user)
    {
        $data =  request()->validate([

            'name'        => 'required',
            'email'       => 'required|email|unique:users,email,'.$user->id,
            'password'    => 'nullable|min:4',
            'role'        => 'required',
            'permissions' => 'required',

        ]);

        $user->update(request()->except(['role','permissions']));

        Role::where('name',$user->getRoles()[0])->update([
            'name' => request('role'),
            'display_name' => request('role')
        ]);

        $user->syncPermissions(request('permissions'));

        Toastr::success('User Updated Successfully!');  

        return back();

    }


    public function destroyUser(User $user)
    {
        $user->delete();
        Toastr::success('User Deleted!');
        return redirect(route('company.users'));
    }

    


    public function show($id,$slug)
    {
        $company = User::findOrFail($id);
        return view('frontend.companies.show',compact('company'));
    }
    
    /**
     * Get All Jobs created by user ( Company )
     */
    public function jobs()
    {
        $jobs = user()->jobs()
               ->with('country:id,name','type:id,name')
    	       ->paginate(10);

    	return view('frontend.companies.jobs',compact('jobs'));

    } // end of fn 


    public function cancelApplicant($job_id,$seeker_id,$company_id)
    {
        if ( request()->ajax())
        { 

          $company  = User::findOrFail($company_id);
          $seeker   = User::findOrFail($seeker_id);
          $listing  = Job::findOrFail($job_id); 

          $listing->applicants()->detach($seeker);

          dispatch(new CanceldEmails($seeker,$company,$listing));

          return response(['canceld'=> true]);

        }
        
        abort(404);

    } // end of fn



    public function applicants(Job $job)
    {
        return view('frontend.companies.applicants',[
            'job'        => $job,
            'applicants' => $job->applicants()->paginate(5) 
        ]);
    }


    

}
