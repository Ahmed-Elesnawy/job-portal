<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\ReplyContactJob;
use App\Models\Contact;
use Illuminate\Http\Request;
use Toastr;

class ContactController extends Controller
{
    public function index()
    {
        $this->readNotofocations();

    	return view('dashboard.contacts.index',[
    		'title'    => 'Contacts Control',
    		'contacts' => Contact::latest()->paginate(5)
    	]);
    }



    public function show(Contact $contact)
    {
        return view('dashboard.contacts.show',[
            'title'   => 'Contact',
            'contact' => $contact
        ]);
    }


    public function reply(Contact $contact,Request $request)
    {
        $reply = $request->validate([

            'reply' => 'required'

        ]);

        ReplyContactJob::dispatch($contact,$reply);

        $contact->update([

            'replied_at' => now()
            
        ]);

        Toastr::success('Reply sent!');

        return redirect()->route('dashboard.contacts.index');
    }

    public function destroy(Contact $contact)
    {

        $contact->delete();

        Toastr::success(trans('dashboard.success_added'));

        return back();

    }


    public function readNotofocations()
    {
    	auth_admin()->unreadNotifications->markAsRead();

    	return response('done!');
    }
}
