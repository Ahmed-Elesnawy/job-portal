<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use DB;
use Toastr; 

class ResetPasswordController extends Controller
{
    public function resetPasswordForm($token)
    {
    	$token = DB::table('password_resets')
    	            -> where('created_at','>',now()->subHours(2))
    	            ->first();

    	if ( $token )
    	{
    		return view('dashboard.auth.reset',compact('token'));
    	}

    	return redirect(aurl('forget/password'));
    }


    public function resetPassword($token)
    {
    	request()->validate([
    		'password' => 'required|confirmed'
    	]);

    	$token = DB::table('password_resets')
    	             ->whereToken($token)
    	             ->first();

    	if ( $token )
    	{
    		$admin = Admin::whereEmail($token->email)->first();

    		$admin->update([
    			'password' => bcrypt(request('password')),
    		]);

    		DB::table('password_resets')->whereEmail($token->email)->delete();

    		auth()->guard('admin')->login($admin);

            Toastr::success(trans('dashboard.success_reset'));

    		return redirect(aurl());
    	}

    	
    	return back();

    }
}
