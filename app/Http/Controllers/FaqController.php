<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\ValueMission;

class FaqController extends Controller
{
    public function index()
    {
        // Récupérer les FAQs actives depuis la base de données
        $faqs = Faq::where('is_active', true)->get();
        
        // Récupérer les valeurs et missions actives depuis la base de données
        $valueMissions = ValueMission::where('is_active', true)->get();
        
        // Renvoyer la vue avec les données
        return view('info', compact('faqs', 'valueMissions'));
    }
}