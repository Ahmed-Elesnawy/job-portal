<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name','email','subject','message','replied_at'];

    
    public function getLimitMessageAttribute()
    {
    	return str_limit($this->message,60);
    }
}
