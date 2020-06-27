<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toastr;
class SettingController extends Controller
{
    public function settingForm()
    {
    	return view('dashboard.settings.edit',['title' => trans('dashboard.settings')]);
    }


    public function setting()
    {
    	request()->validate([
    		'name_en' => 'required',
    		'name_ar' => 'required',
    		'desc'  => 'nullable',
    		'logo' => ['nullable','image'],
    		'status' => ['required','in:open,close'],
    	]);

    	$data = request()->except(['_token']);


        if ( request()->hasFile('logo') )
        {

    	   $data['logo'] = upload('logo','settings',48,48,setting()->logo);

        }

        if ( request()->action == 'save' )
        {
            setting()->update($data);
            Toastr::success(trans('dashboard.success_update'));
            return redirect(route('dashboard.home'));

        }  // End if
        
        else if ( request()->action == 'save-edit' )         
        {
            setting()->update($data);
            Toastr::success(trans('dashboard.success_update'));
            return back();

        } // End else if
    }
}
