<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Toastr;
class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('authadmin');
    }


    public function showLoginForm()
    {
    	return view('dashboard.auth.login');
    }


    public function login()
    {
    	$remember = request('remember') == 1 ? true : false;
    	$loginInfo = ['email' => request('email'),'password' => request('password')];

    	if ( auth()->guard('admin')->attempt($loginInfo,$remember) )
    	{
            Toastr::success(trans('dashboard.success_login'));
    		return redirect(route('dashboard.home'));
    	}
        
        Toastr::error(trans('auth.failed'));

    	return redirect(aurl('login'));
    }
}
