<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $table = 'views';

    protected $fillable = ['visitor','viewable_type','viewable_id'];

    public static function recordView($object)
    {            
            static::create([
            'visitor'       => request()->getSession()->getId(),
            'viewable_type' => get_class($object),
            'viewable_id'   => $object->id
            ]);
    }
}
