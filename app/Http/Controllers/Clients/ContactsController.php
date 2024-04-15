<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contacts;

class ContactsController extends Controller
{
    public function showContactPage()
    {
        if (session('logged_in')) {
            return view('clients.contact');
        }
    
        return view('clients.login');
    }
    
    public function submitContact(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Create a new instance of the Contacts model
        $contact = new Contacts();
        
        // Set the values for the columns in the 'contacts' table
        $contact->subject = $validatedData['subject'];
        $contact->message = $validatedData['message'];

        // Assign the user_id from the session
        $contact->user_id = session('user_id');

        // Save the data to the database
        $contact->save();

        // Set the success message
        $successMessage = 'Your message has been sent!';

        // Redirect the user back to the contact page with the success message
        return view('clients.contact', compact('successMessage'));
    }
}