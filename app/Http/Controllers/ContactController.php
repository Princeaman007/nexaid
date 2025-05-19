<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Ici tu peux soit envoyer un mail soit enregistrer le message
        /*
        Mail::to('tonemail@site.com')->send(new ContactMessageMail($request->all()));
        */

        return back()->with('success', 'Votre message a été envoyé avec succès.');
    }
}
