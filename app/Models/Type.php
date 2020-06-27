<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';

    protected $fillable = ['name','slug'];

    public function jobs()
    {
   	 	return $this->hasMany(Job::class);
   	 	             
    }
}
