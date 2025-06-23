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
        // Statistiques statiques pour la page hiring
        $stats = [
            'hiring_companies' => 150,
            'partnerships_count' => 85,
            'total_interns_placed' => 500,
            'satisfaction_rate' => 95,
            'countries_represented' => 50,
        ];

        return view('compagnies.hiring', compact('stats'));
    }

    /**
     * Affiche la page "Comment travaillons-nous avec les entreprises"
     */
    public function partnership(): View
    {
        // Statistiques statiques pour la page partenariat
        $stats = [
            'active_partnerships' => 75,
            'total_companies' => 320,
            'avg_partnership_duration' => '2.5 ans',
            'success_rate' => 92,
        ];

        // Types de partenariats statiques (en anglais)
        $partnership_types = collect([
            'Strategic',
            'Commercial', 
            'Technology'
        ]);

        // Services populaires statiques (en anglais)
        $popular_services = collect([
            'Recruitment consulting' => 45,
            'Cross-cultural training' => 38,
            'Technology tools' => 32,
            'Marketing support' => 28,
            'Personalized follow-up' => 35,
            'Legal documentation' => 25
        ]);

        return view('compagnies.partnership', compact('stats', 'partnership_types', 'popular_services'));
    }

    /**
     * Affiche la page "Envoyer une offre"
     */
    public function offerSender(): View
    {
        // La vue send-offer.blade.php a toutes ses données hardcodées
        // Nous n'avons pas besoin de passer de variables car elles ne sont pas utilisées
        return view('compagnies.send-offer');
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
            'sectors' => $this->getStaticSectors(),
            'skills' => $this->getStaticSkills(),
            'languages' => $this->getStaticLanguages(),
            'partnership_types' => $this->getStaticPartnershipTypes(),
            'services' => $this->getStaticServices(),
        ];

        return view('compagnies.register', compact('type', 'formData'));
    }

    /**
     * Traite l'inscription d'une compagnie (simulation)
     */
    public function register(Request $request): RedirectResponse
    {
        $type = $request->input('type', 'hiring');

        // Validation de base
        $baseRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
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

        // Simulation d'enregistrement - générer un ID fictif
        $simulatedId = rand(1000, 9999);

        // Messages de succès
        $messages = [
            'hiring' => 'Votre demande de recrutement a été envoyée avec succès !',
            'partnership' => 'Votre demande de partenariat a été envoyée avec succès !',
            'offer_sender' => 'Votre offre de stage a été publiée avec succès !',
        ];

        return redirect()->back()
            ->with('success', $messages[$type] ?? 'Votre inscription a été enregistrée avec succès !')
            ->with('company_type', $type)
            ->with('company_id', $simulatedId);
    }

    // Méthodes privées pour les données statiques (en anglais)
    private function getStaticSectors(): array
    {
        return [
            'IT', 'Marketing', 'Finance', 'Design', 
            'Engineering', 'Legal', 'Commerce', 'Communication',
            'Human Resources', 'Logistics', 'Research & Development',
            'Environment', 'Health', 'Education', 'Tourism'
        ];
    }

    private function getStaticSkills(): array
    {
        return [
            'JavaScript', 'Python', 'Java', 'React', 'Node.js',
            'SQL', 'Git', 'Agile', 'Communication', 'English',
            'PHP', 'Vue.js', 'Angular', 'Docker', 'AWS',
            'Machine Learning', 'Data Analysis', 'SEO', 'Adobe Creative Suite',
            'Project Management', 'Figma', 'Tableau', 'Excel'
        ];
    }

    private function getStaticLanguages(): array
    {
        return [
            'French', 'English', 'Spanish', 'German', 'Italian',
            'Portuguese', 'Mandarin', 'Japanese', 'Arabic', 'Russian',
            'Dutch', 'Korean'
        ];
    }

    private function getStaticPartnershipTypes(): array
    {
        return [
            'Strategic', 'Commercial', 'Technology',
            'Educational', 'Research', 'Innovation'
        ];
    }

    private function getStaticServices(): array
    {
        return [
            'Recruitment consulting', 'Cross-cultural training',
            'Technology tools', 'Marketing support',
            'Personalized follow-up', 'Legal documentation',
            'Visa assistance', 'Language training'
        ];
    }
}