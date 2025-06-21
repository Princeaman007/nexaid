<?php
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyRegistration;
use App\Models\InternshipOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PublicRegistrationController extends Controller
{
    public function showForm(Request $request)
    {
        $type = $request->get('type', 'hiring');
        
        return view('company.register', [
            'type' => $type,
            'formData' => $this->getFormData(),
        ]);
    }

    public function register(Request $request)
    {
        $type = $request->input('type', 'hiring');
        
        $validator = $this->getValidator($request, $type);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::transaction(function () use ($request, $type) {
                $company = $this->createCompany($request, $type);
                $this->createRegistration($request, $company, $type);
                
                if ($type === 'offer_sender') {
                    $this->createInternshipOffer($request, $company);
                }
            });

            return redirect()->back()->with('success', $this->getSuccessMessage($type));
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de l\'inscription.')->withInput();
        }
    }

    private function getValidator(Request $request, string $type): \Illuminate\Validation\Validator
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'phone' => 'nullable|string',
            'website' => 'nullable|url',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
        ];

        if ($type === 'offer_sender') {
            $rules = array_merge($rules, [
                'offer_title' => 'required|string|max:255',
                'offer_description' => 'required|string',
            ]);
        }

        return Validator::make($request->all(), $rules);
    }

    private function createCompany(Request $request, string $type): Company
    {
        return Company::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
            'address' => $request->input('address'),
            'description' => $request->input('description'),
            'team_size' => $request->input('team_size'),
            'type' => $type,
            'status' => 'pending',
        ]);
    }

    private function createRegistration(Request $request, Company $company, string $type): void
    {
        $data = [
            'company_id' => $company->id,
            'type' => $type,
            'status' => 'pending',
        ];

        // Ajouter les données spécifiques selon le type
        match($type) {
            'hiring' => $this->addHiringData($data, $request),
            'partnership' => $this->addPartnershipData($data, $request),
            'offer_sender' => null, // Les données de l'offre sont dans InternshipOffer
        };

        CompanyRegistration::create($data);
    }

    private function addHiringData(array &$data, Request $request): void
    {
        $data = array_merge($data, [
            'sectors_interested' => $request->input('sectors_interested', []),
            'languages_needed' => $request->input('languages_needed', []),
            'intern_duration_preference' => $request->input('intern_duration_preference'),
            'has_international_projects' => $request->boolean('has_international_projects'),
            'cultural_diversity_goals' => $request->input('cultural_diversity_goals'),
        ]);
    }

    private function addPartnershipData(array &$data, Request $request): void
    {
        $data = array_merge($data, [
            'services_needed' => $request->input('services_needed', []),
            'partnership_type' => $request->input('partnership_type'),
            'partnership_duration' => $request->input('partnership_duration'),
            'budget_range' => $request->input('budget_range'),
            'long_term_partnership' => $request->boolean('long_term_partnership'),
            'collaboration_expectations' => $request->input('collaboration_expectations'),
        ]);
    }

    private function createInternshipOffer(Request $request, Company $company): void
    {
        InternshipOffer::create([
            'company_id' => $company->id,
            'title' => $request->input('offer_title'),
            'description' => $request->input('offer_description'),
            'location' => $request->input('offer_location'),
            'salary_amount' => $request->input('salary_amount'),
            'start_date' => $request->input('offer_start_date'),
            'end_date' => $request->input('offer_end_date'),
            'remote_possible' => $request->boolean('remote_possible'),
            'required_skills' => $request->input('required_skills', []),
            'status' => 'draft',
        ]);
    }

    private function getFormData(): array
    {
        return [
            'sectors' => [
                'Informatique', 'Marketing', 'Finance', 'Design',
                'Ingénierie', 'Juridique', 'Commerce', 'Communication'
            ],
            'languages' => [
                'Français', 'Anglais', 'Espagnol', 'Allemand',
                'Italien', 'Chinois', 'Arabe'
            ],
            'services' => [
                'Conseil en recrutement', 'Formation interculturelle',
                'Outils technologiques', 'Support marketing',
                'Accompagnement stratégique', 'Autre'
            ],
            'partnership_types' => [
                'Stratégique', 'Commercial', 'Technologique'
            ],
            'skills' => [
                'JavaScript', 'Python', 'Java', 'React', 'Node.js',
                'SQL', 'Git', 'Agile', 'Communication', 'Anglais',
                'Figma', 'Photoshop'
            ],
        ];
    }

    private function getSuccessMessage(string $type): string
    {
        return match($type) {
            'hiring' => 'Votre demande de recrutement a été envoyée avec succès. Nous vous contacterons sous 24h.',
            'partnership' => 'Votre demande de partenariat a été envoyée. Un conseiller vous contactera prochainement.',
            'offer_sender' => 'Votre offre de stage a été créée et sera publiée après validation.',
            default => 'Votre inscription a été enregistrée avec succès.'
        };
    }
}