<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toastr;

class LogOutController extends Controller
{
    public function logout()
    {
    	auth()->guard('admin')->logout();
    	
    	Toastr::success(trans('dashboard.success_logout'));

    	return redirect(aurl('login'));
    }
}
