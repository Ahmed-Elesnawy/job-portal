<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        // Welcome Route (Home Page)

        Route::get('/', 'WelcomeController@index');

        // Notifications Routes 

        Route::get('company/notifications', 'NotificationController@companyNotifications')->name('company.notifications');

        // Profile Route

        Route::get('profile', 'ProfileController@ShowEditProfile')->name('profile');
        Route::post('profile', 'ProfileController@updateProfile')->name('profile.update');
        Route::put('profile/password/change', 'ProfileController@changePassword')->name('profile.change');

        // Cancel Seeker

        Route::delete('cancel/{job}/{seeker}/{company}/send', 'CompanyController@cancelApplicant')->name('companies.cancel');

        // Users Routes

        Route::get('seekers', 'SeekerController@index')->name('seekers.index');
        Route::get('companies', 'CompanyController@index')->name('companies.index');
        Route::get('seekers/{id}/{slug}', 'SeekerController@show')->name('seekers.show');
        Route::get('companies/{id}/{slug}', 'CompanyController@show')->name('companies.show');
        Route::get('company/jobs', 'CompanyController@jobs')->name('company.jobs');
        Route::post('jobs/{slug}/apply', 'SeekerController@applyJob')->name('jobs.apply');
        Route::post('jobs/{slug}/save', 'SeekerController@saveJob')->name('jobs.save');
        Route::get('jobs/saved', 'SeekerController@savedJobs')->name('jobs.saved');
        Route::get('company/{job}/applicants', 'CompanyController@applicants')->name('company.applicants');
        Route::get('company/users','CompanyController@users')->name('company.users');
        Route::delete('company/users/destroy/{user}', 'CompanyController@destroyUser')->name('company.users.destroy');
        Route::get('company/users/edit/{user}', 'CompanyController@editUserPage')->name('company.users.edit');
        Route::put('company/users/edit/{user}', 'CompanyController@updateUser')->name('company.users.update');
        Route::get('company/users/create','CompanyController@createUserPage')->name('jobs.company.users.create');
        Route::post('company/users/create', 'CompanyController@storeUser')->name('jobs.company.users.store');
        Route::delete('jobs/saved/{slug}/destroy', 'SeekerController@destroySaved')->name('jobs.destroySaved');
        Route::get('jobs/applied', 'SeekerController@appliedJobs')->name('jobs.applied');
        Route::delete('jobs/applied/{slug}/destroy', 'SeekerController@destroyApplied')->name('jobs.destroyApplied');


       
           
        // Tags Routes

        Route::get('jobs/tags/{slug}', 'TagController@jobsShow')->name('tags.jobs.show');
        Route::get('posts/tags/{slug}', 'TagController@postsShow')->name('tags.posts.show');

        // Skills Routes

        Route::get('skills/{slug}', 'SkillController@show')->name('skills.show');

        // Categories Routes

        Route::get('categories/{slug}', 'CategoryController@show')->name('categories.show');


        // Jobs Routes

        Route::resource('jobs', 'JobController')->except(['show']);
        Route::get('jobs/{slug}', 'JobController@show')->name('jobs.show');
           

        // Posts Routes

        Route::resource('posts', 'PostController')->except(['show']);
        Route::get('posts/{slug}', 'PostController@show')->name('posts.show');

        // Contact Routes

        Route::get('contact', 'ContactController@showContactPage')->name('contact.get');
        Route::post('contact', 'ContactController@contact')->name('contact.post');

        // Auth Route

        Auth::routes();
    }
);
