<?php

namespace App\Http\Controllers;

use App\Http\Requests\FrontEnd\ContactRequest;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\ContactSentNotification;
use Illuminate\Http\Request;
use Toastr;

class ContactController extends Controller
{
    public function showContactPage()
    {
    	return view('frontend.contacts.index');
    }

    public function contact(ContactRequest $request)
    {

    	if ( Contact::whereEmail($request->email)->exists() )
    	{
    		Toastr::error('Your Email Contacted Before');
    		return back();
    	}

    	$contact = Contact::create($request->all());

        Admin::findOrFail(1)->notify(new ContactSentNotification($contact->name));

    	Toastr::success('We Recived Your Mail , Thanks!');

    	return back();

    }
}
