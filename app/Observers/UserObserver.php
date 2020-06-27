<?php

namespace App\Observers;

use App\Models\CompanyProfile;
use App\Models\SeekerProfile;
use App\Models\User;
use App\Services\UserService;

class UserObserver
{
    public function created(User $user)
    {
        $user->attachRole($user->level);
    }



    public function roleAttached(User $user)
    {
        if ($user->hasRole('seeker')) 
        {
            $profile = SeekerProfile::create();
            $profile->user()->save($user);
        }

        if ($user->hasRole('company')) 
        {
            $profile = CompanyProfile::create();
            $profile->user()->save($user);
        }
    }


    public function deleted(User $user)
    {
        if ( $user->profile )
        {
            $user->profile()->delete();
        }
      
        if ($user->hasSeekerProfile) 
        {
            check_file($user->profile->cv);
        }
        check_file($user->image);
    }
}
