<?php

namespace App\Providers;


use App\Models\Admin;
use App\Models\Job;
use App\Models\Type;
use App\Models\User;
use App\Models\Post;

use App\Observers\AdminObserver;
use App\Observers\JobObserver;
use App\Observers\TypeObserver;
use App\Observers\UserObserver;
use App\Observers\PostObserver;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Admin::observe(AdminObserver::class);
        User::laratrustObserve(UserObserver::class);
        User::observe(UserObserver::class);
        Post::observe(PostObserver::class);
        Type::observe(TypeObserver::class);
        Job::observe(JobObserver::class);
        View::share('categories',\App\Models\Category::withCount('jobs')->orderBy('jobs_count','desc')->get());
        View::share('countries',\App\Models\Country::withCount('jobs')->orderBy('jobs_count')->get());
        View::share('types',\App\Models\Type::withCount('jobs')->get());
        View::share('tags',\App\Models\Tag::withCount('jobs')->get());
        View::share('skills',\App\Models\Skill::withCount('jobs')->get());
        View::share('admins_count',\App\Models\Admin::all()->count());
        View::share('seekers_count',\App\Models\User::seekers()->count());
        View::share('companies_count',\App\Models\User::companies()->count());
        View::share('countries_count',\App\Models\Country::all()->count());


    }
}
