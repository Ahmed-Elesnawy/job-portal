<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use DB;
use Mail;
use App\Mail\AdminResetPasswordMail;
use Toastr;

class ForgetPasswordController extends Controller
{
    public function ForgetPassword()
    {
    	$admin = Admin::where('email',request('email'))->first();
    	
    	if ( !empty($admin) )
    	{
    		$token = app('auth.password.broker')->createToken($admin);

    		DB::table('password_resets')->insert([
    			'email' => $admin->email,
    			'token' => $token,
    			'created_at' => now()
    		]);

    		Mail::to($admin->email)
    		->send(new AdminResetPasswordMail(['admin'=>$admin,'token'=>$token]));

    		Toastr::success(trans('dashboard.email_sent'));

    		return back();


    	}

    	return back();
    }
}
