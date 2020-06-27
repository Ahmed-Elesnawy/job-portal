<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    
    protected $fillable = ['title','slug','body','admin_id','image'];


    public function views()
    {
        return $this->morphMany(\App\Models\View::class,'viewable');
    }

    public function tags()
    {
    	return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    public function admin()
    {
    	return $this->belongsTo(Admin::class);
    }


    public function getReadTimeAttribute()
    {
        return get_reading_time($this->body);
    }

    public function getImagePathAttribute()
    {
        return url('storage/'. $this->image);
    }


    public function getLimitBodyAttribute()
    {
    	return str_limit($this->body,80);
    }

    public function getShowUrlAttribute()
    {
    	return route('posts.show',$this->slug);
    }


    public function getNextPostAttribute()
    {
        $next = static::where('id','>',$this->id)->first();
        return $next;
    }

    public function getPrevPostAttribute()
    {
        $id   = static::where('id','<',$this->id)->max('id');
        $prev = static::find($id); 
        return $prev;
    }

   
}



