<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function AdminContact()
    {
        $contact = Contact::all();
        return view('admin.contact.index', compact('contact'));
    }


    public function AdminAddContact()
    {
        return view('admin.contact.create');
    }

    public function AdminStoreContact(Request $request)
    {
        Contact::insert([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return Redirect()->route('admin.contact')->with('success', 'Add Contact Successfully');
    }

    public function AdminEditContact($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.edit', compact('contact'));
    }

    public function AdminUpdateContact(Request $request, $id)
    {
        Contact::find($id)->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('admin.contact')->with('success', 'Update Contact Successfully');
    }

    public function AdminDeleteContact($id)
    {
        Contact::find($id)->delete();
        return Redirect()->route('admin.contact')->with('success', 'Delete Contact Successfully');
    }

    public function Contact()
    {
        $contact = DB::table('contacts')->first();
        return view('pages.contact', compact('contact'));
    }


    public function ContactForm(Request $request)
    {
        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.contact')->with('success', 'Sending Message successfully');
    }

    public function AdminContactMessage()
    {
        $message = ContactForm::all();
        return view('admin.contact.contact_message', compact('message'));
    }
}
