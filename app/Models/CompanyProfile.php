<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $guarded = [];

    public function user()
    {
    	return $this->morphOne(User::class,'profile');
    }
}
