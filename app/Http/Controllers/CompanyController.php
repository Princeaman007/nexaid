<?php
namespace App\Http\Controllers;


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
        // Statistiques pour la page hiring
        $stats = [
            'hiring_companies' => Company::hiring()->active()->count(),
            'partnerships_count' => Company::partnership()->active()->count(),
            'total_interns_placed' => 500,
            'satisfaction_rate' => 95,
            'countries_represented' => 50,
        ];

        // Témoignages d'entreprises de type hiring
        $testimonials = Company::hiring()
            ->verified()
            ->whereNotNull('cultural_diversity_goals')
            ->latest()
            ->take(3)
            ->get();

        // ✅ CORRECTION : Utiliser le bon chemin de vue
        return view('compagnies.hiring', compact('stats', 'testimonials'));
    }

    /**
     * Affiche la page "Comment travaillons-nous avec les entreprises"
     */
    public function partnership(): View
    {
        // Statistiques pour la page partenariat
        $stats = [
            'active_partnerships' => Company::partnership()->active()->count(),
            'total_companies' => Company::active()->count(),
            'avg_partnership_duration' => '2.5 ans',
            'success_rate' => 92,
        ];

        // Types de partenariats disponibles
        $partnership_types = Company::partnership()
            ->whereNotNull('partnership_type')
            ->pluck('partnership_type')
            ->unique()
            ->values();

        // Services les plus demandés
        $popular_services = Company::partnership()
            ->whereNotNull('services_needed')
            ->get()
            ->pluck('services_needed')
            ->flatten()
            ->countBy()
            ->sortDesc()
            ->take(6);

        // ✅ CORRECTION : Utiliser le bon chemin de vue
        return view('compagnies.partnership', compact('stats', 'partnership_types', 'popular_services'));
    }

    /**
     * Affiche la page "Envoyer une offre"
     */
    public function offerSender(): View
    {
        // Statistiques pour la page offres
        $stats = [
            'active_offers' => Company::offerSender()
                ->where('offer_status', Company::OFFER_STATUS_ACTIVE)
                ->count(),
            'companies_posting' => Company::offerSender()->active()->count(),
            'avg_response_time' => '3 jours',
            'placement_rate' => 78,
        ];

        // Secteurs les plus recherchés
        $popular_sectors = Company::offerSender()
            ->whereNotNull('required_skills')
            ->get()
            ->pluck('required_skills')
            ->flatten()
            ->countBy()
            ->sortDesc()
            ->take(8);

        // Exemples d'offres récentes
        $recent_offers = Company::offerSender()
            ->where('offer_status', Company::OFFER_STATUS_ACTIVE)
            ->whereNotNull('offer_title')
            ->latest()
            ->take(4)
            ->get(['offer_title', 'offer_location', 'remote_possible', 'required_skills']);

        // ✅ CORRECTION : Utiliser le bon chemin de vue
        return view('compagnies.send-offer', compact('stats', 'popular_sectors', 'recent_offers'));
    }

    /**
     * Affiche le formulaire d'inscription selon le type
     */
    public function showRegistrationForm(Request $request): View
    {
        $type = $request->get('type', 'hiring');
        
        if (!in_array($type, ['hiring', 'partnership', 'offer_sender'])) {
            $type = 'hiring';
        }

        $formData = [
            'sectors' => $this->getUniqueSectors(),
            'skills' => $this->getUniqueSkills(),
            'languages' => $this->getUniqueLanguages(),
            'partnership_types' => $this->getUniquePartnershipTypes(),
            'services' => $this->getUniqueServices(),
        ];

        // ✅ CORRECTION : Utiliser le bon chemin de vue
        return view('compagnies.register', compact('type', 'formData'));
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

        // Ajouter des valeurs par défaut
        $validated['is_active'] = true;
        $validated['status'] = 'pending';
        if ($type === 'offer_sender') {
            $validated['offer_status'] = Company::OFFER_STATUS_DRAFT;
        }

        // Créer la compagnie
        $company = Company::create($validated);

        // Messages de succès
        $messages = [
            'hiring' => 'Votre demande de recrutement a été envoyée avec succès !',
            'partnership' => 'Votre demande de partenariat a été envoyée avec succès !',
            'offer_sender' => 'Votre offre de stage a été publiée avec succès !',
        ];

        return redirect()->back()
            ->with('success', $messages[$type] ?? 'Votre inscription a été enregistrée avec succès !')
            ->with('company_type', $type)
            ->with('company_id', $company->id);
    }

    // Méthodes privées pour récupérer les données uniques
    private function getUniqueSectors(): array
    {
        $sectors = Company::whereNotNull('sectors_interested')
            ->get()
            ->pluck('sectors_interested')
            ->flatten()
            ->unique()
            ->values()
            ->toArray();

        return !empty($sectors) ? $sectors : [
            'Informatique', 'Marketing', 'Finance', 'Design', 
            'Ingénierie', 'Juridique', 'Commerce', 'Communication'
        ];
    }

    private function getUniqueSkills(): array
    {
        $skills = Company::whereNotNull('required_skills')
            ->get()
            ->pluck('required_skills')
            ->flatten()
            ->unique()
            ->values()
            ->toArray();

        return !empty($skills) ? $skills : [
            'JavaScript', 'Python', 'Java', 'React', 'Node.js',
            'SQL', 'Git', 'Agile', 'Communication', 'Anglais'
        ];
    }

    private function getUniqueLanguages(): array
    {
        $languages = Company::whereNotNull('languages_needed')
            ->get()
            ->pluck('languages_needed')
            ->flatten()
            ->unique()
            ->values()
            ->toArray();

        return !empty($languages) ? $languages : [
            'Français', 'Anglais', 'Espagnol', 'Allemand', 'Italien'
        ];
    }

    private function getUniquePartnershipTypes(): array
    {
        $types = Company::partnership()
            ->whereNotNull('partnership_type')
            ->pluck('partnership_type')
            ->unique()
            ->values()
            ->toArray();

        return !empty($types) ? $types : [
            'Stratégique', 'Commercial', 'Technologique'
        ];
    }

    private function getUniqueServices(): array
    {
        $services = Company::whereNotNull('services_needed')
            ->get()
            ->pluck('services_needed')
            ->flatten()
            ->unique()
            ->values()
            ->toArray();

        return !empty($services) ? $services : [
            'Conseil en recrutement', 'Formation interculturelle',
            'Outils technologiques', 'Support marketing'
        ];
    }
}
