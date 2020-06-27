<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


   /**
   * Values that can be filled by user in Model
   * @var array
   */

   protected $fillable = [ 'name' , 'slug' ];

   
   protected static function  boot()
    {
    	parent::boot();

    	static::creating(function($category){
    		$category->slug = Str::slug($category->name);
    	});

    	static::updating(function($category){
    		$category->slug = Str::slug($category->name);
    	});
    }



   /**
   * One To Many relation
   *
   * @return void 
   * 
   */

   public function jobs()
   {
   	 return $this->hasMany(Job::class);
            
   }
}
