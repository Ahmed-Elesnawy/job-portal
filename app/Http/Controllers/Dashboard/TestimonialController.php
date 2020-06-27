<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\TestimonialsDataTable;
use App\Models\Testimonial;
use Image;
use Storage;
use Toastr;


class TestimonialController extends Controller
{
    public function index(TestimonialsDataTable $testimonials)
    {
    	return $testimonials->render('dashboard.testimonials.index',['title' => trans('dashboard.testimonials')]);

    } // End of index fn 


    public function create()
    {
    	return view('dashboard.testimonials.create',['title' => trans('dashboard.add_new_testimonial')]);

    } // End of create fn


    public function store(Request $request)
    {
    	$data = $request->validate([

            'name'=> ['required','unique:testimonials'],
            'say' => ['required','max:200']

    	]);


    	$testimonial = Testimonial::create($data);
        Toastr::success(trans('dashboard.success_added'));
        
        if ( $request->action == 'save-edit' )
        {
            return redirect(route('dashboard.testimonials.edit',$testimonial->id));
        }

        if ( $request->action == 'save-add' )
        {
            return back();
        }

        return redirect(route('dashboard.testimonials.index'));

    } // end of store fn


    public function edit(Testimonial $testimonial)
    {
        $title = trans('dashboard.edit',['name' => $testimonial->name]);
        return view('dashboard.testimonials.edit',compact('testimonial','title'));

    } // End of edit fn


    public function update(Testimonial $testimonial,Request $request)
    {
        $data = $request->validate([

            'name'=> ['required','unique:testimonials,name,'.$testimonial->id],
            'say' => ['required','max:200'],
        ]);

        $testimonial->update($data);

        Toastr::success(trans('dashboard.success_update'));

        return back();

    } // End of update fn



    public function destroy(Testimonial $testimonial)
    {

        $testimonial->delete();

        Toastr::success(trans('dashboard.success_delete'));

        return redirect(route('dashboard.testimonials.index'));

    } // End of destroy fn




    public function destroyAll()
    {
        
        Testimonial::destroy(request('item'));

        Toastr::success(trans('dashboard.success_delete'));

        return redirect(route('dashboard.testimonials.index'));

    } // End Of destroyAll fn




   


     

}
