<?php

namespace App\Models;

use Storage;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{



    protected $table = 'jobs_listings';

    protected $fillable = [
    	'title',
        'slug',
        'banner',
        'description',
    	'exp_level',
    	'salary',
    	'type_id',
    	'category_id',
        'country_id',
    	'user_id',
    	'apply_url',
    ];


   
    /**
    * One To Many Relationship every job Belong to one user   
    *
    * @return void 
    */

    public function user()
    {
      return $this->belongsTo('App\Models\User');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
    * Each job has many tags Morph relation 
    * @return void 
    */
    public function tags()
    {
    	return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    /**
    * Many to many relation ship job_skill table 
    * @return void 
    */
    public function skills()
    {
    	return $this->belongsToMany(Skill::class);
    }


    /**
    * Many to many relation ship job_seeker table 
    * @return void 
    */

    public function seekers()
    {
        return $this->belongsToMany(User::class,'job_seeker');
                     
    }

    /**
    * Many to many relation ship job_applicant table 
    * @return void 
    */

    public function applicants()
    {
        return $this->belongsToMany(User::class,'job_applicant');
                    
    }

    /**
    * Custom attr to get path of image 
    * @return string path
    */
    public function getImagePathAttribute()
    {
        return Storage::url($this->banner);
    }

    /**
    * Custom attr to get show url for each particular instance 
    *
    * @return string path 
    */
    public function getShowUrlAttribute()
    {
        return route('jobs.show',$this->slug);
    }


    
    

   


    /**
    * method to dublicate particular job and return by new one 
    *
    * @return object 
    */

    public function dublicateJob()
    {
        $new_job = $this->replicate(['banner']);
        $new_job->title = $this->title . '-(dublicated)';
        $new_job->slug = str_slug($new_job->title);
        $new_job->push();

        foreach ( $this->skills as $skill )
        {
            $new_job->skills()->attach($skill);
        }

        foreach ( $this->tags as $tag )
        {
            $new_job->tags()->attach($tag);
        }


        return $new_job;
    }



    


   
    

}
