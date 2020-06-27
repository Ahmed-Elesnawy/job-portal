<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
    	$category = Category::whereSlug($slug)->firstOrFail();
    	$jobs     = $category->jobs()->with('type:id,name','country:id,name')->paginate(10);
    	
    	return view('frontend.categories.show',compact('category','jobs'));
    }
}
