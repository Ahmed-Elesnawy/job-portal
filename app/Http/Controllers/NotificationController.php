<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:company'])->only(['companyNotifications']);
    }

    public function companyNotifications()
    {
        
        user()->notifications->markAsRead();
        
        return view('frontend.notifications.index',[

            'nots' => user()->notifications()->latest()->paginate(5),

        ]);

    } // end of fn 
}
