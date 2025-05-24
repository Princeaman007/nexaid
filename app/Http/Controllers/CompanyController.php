<?php

namespace App\Http\Controllers;

use App\Models\CompanyOffer;
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
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'poste' => 'required|string|max:255',
            'duree' => 'required|string|max:255',
            'competences' => 'required|string',
            'remuneration' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        // Ajouter le statut par défaut
        $validated['statut'] = 'pending';

        CompanyOffer::create($validated);

        return back()->with('success', 'Votre offre a été soumise avec succès. Notre équipe la traitera dans les plus brefs délais.');
    }
}