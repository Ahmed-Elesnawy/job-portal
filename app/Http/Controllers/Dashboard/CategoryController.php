<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CategoriesDataTable;
use App\Models\Category;
use Image;
use Storage;
use Toastr;


class CategoryController extends Controller
{
    public function index(CategoriesDataTable $categories)
    {
    	return $categories->render('dashboard.categories.index',['title' => trans('dashboard.categories')]);

    } // End of index fn 


    public function create()
    {
    	return view('dashboard.categories.create',['title' => trans('dashboard.add_new_category')]);

    } // End of create fn


    public function store(Request $request)
    {
        $data = $request->validate([

            'name'=> ['required','unique:categories'],

        ]);

        $category = Category::create($data);

        Toastr::success(trans('dashboard.success_added'));

        if ( $request->action == 'save-edit' )
        {
            return redirect(route('dashboard.categories.edit',$category->id));
        }

        if ( $request->action == 'save-add' )
        {
            return back();
        }

        return redirect(route('dashboard.categories.index'));

    } // end of store fn


    public function edit(Category $category)
    {
        $title = trans('dashboard.edit',['name' => $category->name]);
        return view('dashboard.categories.edit',compact('category','title'));

    } // End of edit fn


    public function update(Category $category,Request $request)
    {
        $data = $request->validate([

            'name'=> ['required','unique:categories,name,'.$category->id],
        ]);

        $category->update($data);

        Toastr::success(trans('dashboard.success_update'));

        return back();

    } // End of update fn



    public function destroy(Category $category)
    {

        $category->delete();

        Toastr::success(trans('dashboard.success_delete'));

        return redirect(route('dashboard.categories.index'));

    } // End of destroy fn




    public function destroyAll()
    {
        
        $ids = request('item');

        Category::destroy($ids);

        Toastr::success(trans('dashboard.success_delete'));

        return redirect(route('dashboard.categories.index'));

    } // End Of destroyAll fn

}

