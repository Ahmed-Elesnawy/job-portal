<?php

namespace App\Http\Controllers\Dashboard;

use App\Charts\CategoryChart;
use App\Charts\TypeChart;
use App\Charts\UserChart;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Country;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
       
        $categorychart   = draw_chart(CategoryChart::class,Category::latest()->pluck('name'),Category::withCount('jobs')->latest()->pluck('jobs_count'));
        $typechart       = draw_chart(TypeChart::class,Type::latest()->pluck('name'),Type::withCount('jobs')->latest()->pluck('jobs_count'),'pie');

        /*** Prepare data for draw user register chart by month in current year ***/
        
        $data=[];

        foreach( get_months() as $key => $value )
        {
            $data[$value] = User::whereYear('created_at',date('Y'))->whereMonth('created_at',$key)->count();
        }

        $data = collect($data); // Drawing data 

        $userchart = draw_chart(UserChart::class,$data->keys(),$data->values(),'line','User Registerd By Month');


    	return view('dashboard.home',[

            'title'         => trans('dashboard.home'),
            'categorychart' => $categorychart,
            'userchart'     => $userchart,
            'typechart'     => $typechart

        ]);

    } // End of index fn
}
