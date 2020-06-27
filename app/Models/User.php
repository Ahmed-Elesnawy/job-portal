<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;
    use LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name', 'email', 'password','level','info','github','facebook',
        'linkedin','twitter','image','company_id'
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['profile'];

    /**
    * Scope to limit users that bring role company
    * @param  $query
    * @return void
    **/

    public function scopeCompanies($query)
    {
        return $query->whereRoleIs('company');
                     
    }


    /**
    * Scope to limit users that bring role seeker
    * @param  $query
    * @return void
    **/

    public function scopeSeekers($query)
    {
        return $query->whereRoleIs('seeker');             
    }

   


    /**
    * Set Hashed password before inserting to users table 
    * @param string $value --> pass 
    * @return void
    */
    
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
    * Relation ship between users and profile one to one 
    * @return void
    */

    public function profile()
    {
        return $this->morphTo();
    }

    public function getSeekerShowAttribute()
    {
        return route('seekers.show',['id' => $this->id,'slug' => Str::slug($this->name)]);
    }


    public function getCompanyShowAttribute()
    {
        return route('companies.show',['id' => $this->id,'slug' => Str::slug($this->name)]);
    }

    /**
    * Check profile type of user instance 
    * @return bool
    */

    public function getHasSeekerProfileAttribute()
    {
        return $this->profile_type == 'App\Models\SeekerProfile';
    }

    /**
    * Check profile type of user instance 
    * @return bool
    */

    public function getHasCompanyProfileAttribute()
    {
        return $this->profile_type == 'App\Models\CompanyProfile';
    }

    /**
    * Relation get all jobs whose created by company one to many
    * @return void
    */

    public function jobs()
    {
        return $this->hasMany(Job::class);
                
    }

    public function company()
    {
        return $this->belongsTo(self::class,'company_id');
    }

    public function admins()
    {
        return $this->hasMany(self::class,'company_id');
    }

    /**
    * Relation get all jobs whose applied by seeker many to many
    * @return void
    */
   
    public function appliedJobs()
    {
        return $this->belongsToMany(Job::class,'job_applicant');
    }

    /**
    * Add attribute to instance called imagePath to get path of image
    * @return string path
    */
    public function getImagePathAttribute()
    {
        return url('storage/'.$this->image);
    }

   


    /**
    * Relation get all jobs whose saved by seeker many to many
    * @return void
    */

    public function savedJobs()
    {
        return $this->belongsToMany(Job::class,'job_seeker');
    }

    /**
    * Check of seeker saved the given job
    * @param object $job
    * @return bool
    */
    public function hasSavedJob($job)
    {
        return $this->savedJobs->contains($job);
    }


     /**
    * Check of seeker applied for the given job
    * @param object $job
    * @return bool
    */

    public function hasAppliedJob($job)
    {
        return $this->appliedJobs->contains($job);
    }
}
