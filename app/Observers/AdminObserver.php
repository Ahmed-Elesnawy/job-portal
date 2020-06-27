<?php

namespace App\Observers;

class AdminObserver
{
    public function deleted($admin)
    {
    	check_file($admin->image);
    }
}
