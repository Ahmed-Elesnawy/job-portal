<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

  
    protected $fillable = [ 'name' , 'slug' ];


    protected static function  boot()
    {
    	parent::boot();

    	static::creating(function($tag){
    		$tag->slug = Str::slug($tag->name);
    	});

    	static::updating(function($tag){
    		$tag->slug = Str::slug($tag->name);
    	});
    }


    


    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'taggable');
    }



    public function jobs()
    {
        return $this->morphedByMany('App\Models\Job', 'taggable');
                    
    }




   



    

}
