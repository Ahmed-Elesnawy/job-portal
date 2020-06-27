<?php

namespace App\Http\Controllers;

use Toastr;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FrontEnd\UserRequest;
class ProfileController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth']);
	}


    public function ShowEditProfile()
    {
    	$user = auth()->user();
    	return view('frontend.profiles.edit',compact('user'));
    } // end of edit fn 



    public function updateProfile(UserRequest $request)
    {
        $data = $request->except(['image']);

        $user = auth()->user();

        if ( $request->hasFile('image') )
        {            
            $data['image'] = upload('image','users',200,200,$user->image);
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


        Toastr::success('Profile updated!');

        return back();
    	
    } // end of update profile fn 


    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password'              => ['required',new MatchOldPassword()],
            'new_password'              => ['required'],
            'new_password_confirmation' => ['same:new_password'] 
        ]);
        auth()->user()->update(['password' => $request->password]);
        auth()->logout();
        Toastr::success('Password changed!');
        return redirect(url('login'));

    } // end of change pass fn 
}
