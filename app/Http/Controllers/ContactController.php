<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }

    public function adminContacts()
    {
        // Check if user is admin
        if (!auth()->check() || (auth()->user()->role !== 'admin' && !auth()->user()->is_admin)) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Access denied. Admin login required.');
        }
        
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contacts', compact('contacts'));
    }

    public function sendReply(Request $request)
    {
        // Check if user is admin
        if (!auth()->check() || (auth()->user()->role !== 'admin' && !auth()->user()->is_admin)) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Access denied. Admin login required.');
        }
        
        $validated = $request->validate([
            'contact_id' => 'required|exists:contacts,id',
            'recipient_email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Send email
        try {
            \Mail::raw($validated['message'], function($message) use ($validated) {
                $message->to($validated['recipient_email'])
                        ->subject($validated['subject'])
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });

            return redirect()->back()->with('reply_success', 'Reply sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send reply. Please check your mail configuration.');
        }
    }
}
