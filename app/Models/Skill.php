<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    protected $fillable = [ 'name' , 'slug' ];

    protected static function  boot()
    {
    	parent::boot();

    	static::creating(function($skill){
    		$skill->slug = Str::slug($skill->name);
    	});

    	static::updating(function($skill){
    		$skill->slug = Str::slug($skill->name);
    	});
    }

    public function jobs()
    {
    	return $this->belongsToMany(Job::class);
    }


   
}
