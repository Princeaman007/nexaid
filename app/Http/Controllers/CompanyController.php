<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function whyIntern()
    {
        return view('company.why-intern');
    }

    public function howItWorks()
    {
        return view('company.how-it-works');
    }

    public function sendOffer()
    {
        return view('company.send-offer');
    }

    public function storeOffer(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email',
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
            'location' => 'required|string|max:255',
        ]);

        // Ici tu peux enregistrer l'offre en base ou envoyer un email
        // Exemple simple : envoyer par email
        
        return back()->with('success', __('Votre offre a été soumise avec succès !'));
    }
    // app/Http/Controllers/InternshipController.php - Ajouter cette méthode si elle manque
    public function applicationSuccess()
    {
        return view('internships.application-success');
    }
}


