<?php


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        // Dashboard routes

        Route::prefix('admin')
        ->name("dashboard.")
        ->group(function () {
            
            // Change Guard If Admin Requested


            // Auth Routes

            Route::get('login', 'Auth\LoginController@showLoginForm')->name('showlogin');
            Route::post('login', 'Auth\LoginController@login')->name('login');
            Route::any('logout', 'Auth\LogOutController@logout')->name('logout');
            Route::post('forget/password', 'Auth\ForgetPasswordController@ForgetPassword')->name('forget');
            Route::get('reset/password/{token}', 'Auth\ResetPasswordController@resetPasswordForm');
            Route::post('reset/password/{token}', 'Auth\ResetPasswordController@resetPassword')->name('reset');


            Route::middleware('admin:admin')->group(function () {

                // Settings Routes

                Route::get('setting', 'SettingController@settingForm');
                Route::put('setting', 'SettingController@setting')->name('setting.update');

                // Dashboard Home Page

                Route::get('/', 'HomeController@index')->name('home');

                // Admins CRUD routes
                
                Route::resource('admins', 'AdminController')->except('show');
                Route::delete('admins/destroy/all', 'AdminController@destroyAll')->name('admins.destroy.all');

                // Users CRUD routes
                
                Route::resource('users', 'UserController')->except('show');
                Route::delete('users/destroy/all', 'UserController@destroyAll')->name('users.destroy.all');

                // Types CRUD routes
                
                Route::resource('types', 'TypeController')->except('show');
                Route::delete('types/destroy/all', 'TypeController@destroyAll')->name('types.destroy.all');


                // Countries CRUD routes
                
                Route::resource('countries', 'CountryController')->except('show');
                Route::delete('countries/destroy/all', 'CountryController@destroyAll')->name('countries.destroy.all');


                // Skills CRUD routes
                
                Route::resource('skills', 'SkillController')->except('show');
                Route::delete('skills/destroy/all', 'SkillController@destroyAll')->name('skills.destroy.all');

                // Tags CRUD routes
                
                Route::resource('tags', 'TagController')->except('show');
                Route::delete('tags/destroy/all', 'TagController@destroyAll')->name('tags.destroy.all');

                // Categories CRUD routes
                
                Route::resource('categories', 'CategoryController')->except('show');
                Route::delete('categories/destroy/all', 'CategoryController@destroyAll')->name('categories.destroy.all');


                // Posts CRUD routes
        
                Route::resource('posts', 'PostController')->except('show');
                Route::delete('posts/destroy/all', 'PostController@destroyAll')->name('posts.destroy.all');

                // Comments CRUD routes
        
                Route::resource('comments', 'CommentController')->except('show');
                Route::delete('comments/destroy/all', 'CommentController@destroyAll')->name('comments.destroy.all');




                // Jobs CRUD routes
        
                Route::resource('jobs', 'JobController')->except('show');
                Route::delete('jobs/destroy/all', 'JobController@destroyAll')->name('jobs.destroy.all');
                Route::get('jobs/dublicate/{job}', 'JobController@dublicate')->name('jobs.dublicate');


                // Testimonials CRUD routes
        
                Route::resource('testimonials', 'TestimonialController')->except('show');
                Route::delete('testimonials/destroy/all', 'TestimonialController@destroyAll')->name('testimonials.destroy.all');

                // Contacts Routes

                Route::get('contacts', 'ContactController@index')->name('contacts.index');
                Route::get('contacts/{contact}', 'ContactController@show')->name('contacts.show');
                Route::post('contacts/{contact}/reply', 'ContactController@reply')->name('contacts.reply');
                Route::delete('contacts/{contact}', 'ContactController@destroy')->name('contacts.destroy');

                // Read notification Route


                Route::get('notification', 'ContactController@readNotofocations')->name('notifications.read');
            });
        });
    }
);
