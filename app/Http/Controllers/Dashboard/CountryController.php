<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CountriesDataTable;
use App\Models\Country;
use Image;
use Storage;
use Toastr;

class CountryController extends Controller
{
    public function index(CountriesDataTable $countries)
    {
    	return $countries->render('dashboard.countries.index',['title' => trans('dashboard.countries')]);

    } // End of index fn 


    public function create()
    {
    	return view('dashboard.countries.create',['title' => trans('dashboard.add_new_country')]);

    } // End of create fn


    public function store(Request $request)
    {
    	$data = $request->validate([

    		'name'=> ['required','unique:countries'],

    	]);

        $country = Country::create($data);

    	Toastr::success(trans('dashboard.success_added'));

        if ( $request->action == 'save-edit' )
        {
            return redirect(route('dashboard.countries.edit',$country->id));
        }

        if ( $request->action == 'save-add' )
        {
            return back();
        }

        return redirect(route('dashboard.countries.index'));

    } // end of store fn


    public function edit(Country $country)
    {
        $title = trans('dashboard.edit',['name' => $country->name]);
        return view('dashboard.countries.edit',compact('country','title'));

    } // End of edit fn


    public function update(Country $country,Request $request)
    {
        $data = $request->validate([

            'name'=> ['required','unique:countries,name,'.$country->id],

        ]);

        $country->update($data);

        Toastr::success(trans('dashboard.success_update'));

        return back();

    } // End of update fn



    public function destroy(Country $country)
    {

        $country->delete();

        Toastr::success(trans('dashboard.success_delete'));

        return redirect(route('dashboard.countries.index'));

    } // End of destroy fn




    public function destroyAll()
    {
        Country::destroy(request('item'));
        Toastr::success(trans('dashboard.success_delete'));
        return redirect(route('dashboard.countries.index'));

    } // End Of destroyAll fn

}
