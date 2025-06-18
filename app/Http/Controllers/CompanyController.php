<?php

// app/Http/Controllers/CompanyController.php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{
    /**
     * Affiche la page "Pourquoi recruter un stagiaire international"
     */
    public function hiring(): View
    {
        return view('companies.hiring');
    }

    /**
     * Affiche la page "Comment travaillons-nous avec les entreprises"
     */
    public function partnership(): View
    {
        return view('companies.partnership');
    }

    /**
     * Affiche la page "Envoyer une offre"
     */
    public function offerSender(): View
    {
        return view('companies.offer-sender');
    }

    /**
     * Affiche le formulaire d'inscription selon le type
     */
    public function showRegistrationForm(Request $request): View
    {
        $type = $request->get('type', 'hiring');
        
        // Vérifier que le type est valide
        if (!in_array($type, ['hiring', 'partnership', 'offer_sender'])) {
            $type = 'hiring';
        }

        return view('companies.register', compact('type'));
    }

    /**
     * Traite l'inscription d'une compagnie
     */
    public function register(Request $request): RedirectResponse
    {
        $type = $request->input('type', 'hiring');

        // Validation de base
        $baseRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:hiring,partnership,offer_sender',
        ];

        // Règles spécifiques selon le type
        $specificRules = [];
        
        switch ($type) {
            case 'hiring':
                $specificRules = [
                    'sectors_interested' => 'nullable|array',
                    'languages_needed' => 'nullable|array',
                    'intern_duration_preference' => 'nullable|string',
                    'team_size' => 'nullable|integer|min:1',
                    'has_international_projects' => 'boolean',
                    'cultural_diversity_goals' => 'nullable|string',
                ];
                break;

            case 'partnership':
                $specificRules = [
                    'partnership_type' => 'nullable|string',
                    'collaboration_expectations' => 'nullable|string',
                    'services_needed' => 'nullable|array',
                    'partnership_duration' => 'nullable|string',
                    'budget_range' => 'nullable|numeric|min:0',
                    'long_term_partnership' => 'boolean',
                ];
                break;

            case 'offer_sender':
                $specificRules = [
                    'offer_title' => 'required|string|max:255',
                    'offer_description' => 'required|string',
                    'required_skills' => 'nullable|array',
                    'offer_location' => 'nullable|string|max:255',
                    'remote_possible' => 'boolean',
                    'offer_start_date' => 'nullable|date|after:today',
                    'offer_end_date' => 'nullable|date|after:offer_start_date',
                    'salary_amount' => 'nullable|numeric|min:0',
                ];
                break;
        }

        $rules = array_merge($baseRules, $specificRules);
        $validated = $request->validate($rules);

        // Créer la compagnie
        $company = Company::create($validated);

        // Message de succès selon le type
        $messages = [
            'hiring' => __('Votre demande de recrutement a été envoyée avec succès !'),
            'partnership' => __('Votre demande de partenariat a été envoyée avec succès !'),
            'offer_sender' => __('Votre offre de stage a été publiée avec succès !'),
        ];

        return redirect()->route('company.success')
            ->with('success', $messages[$type] ?? __('Votre inscription a été enregistrée avec succès !'))
            ->with('company_type', $type);
    }

    /**
     * Page de succès après inscription
     */
    public function success(): View
    {
        return view('companies.success');
    }

    /**
     * Liste toutes les compagnies (pour usage public si nécessaire)
     */
    public function index(): View
    {
        $companies = Company::active()->paginate(20);
        return view('companies.index', compact('companies'));
    }
}