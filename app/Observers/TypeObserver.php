<?php

namespace App\Observers;

use App\Models\Type;
use Illuminate\Support\Str;

class TypeObserver
{
    public function creating($type)
    {
       $type->slug = Str::slug($type->name);
    }

    public function updating($type)
    {
    	$type->slug = Str::slug($type->name);
    }
}
