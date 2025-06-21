<?php
namespace App\Services;

use App\Models\CompanyRegistration;
use App\Models\InternshipOffer;
use App\Models\Partnership;
use App\Notifications\WelcomeNotification;

class CompanyRegistrationService
{
    public function processRegistration(CompanyRegistration $registration): void
    {
        // Auto-traitement selon les critères
        if ($this->shouldAutoApprove($registration)) {
            $this->approveRegistration($registration);
        }

        // Actions spécifiques selon le type
        match($registration->type) {
            'hiring' => $this->processHiringRegistration($registration),
            'partnership' => $this->processPartnershipRegistration($registration),
            'offer_sender' => $this->processOfferSenderRegistration($registration),
        };
    }

    private function shouldAutoApprove(CompanyRegistration $registration): bool
    {
        $company = $registration->company;
        
        // Critères d'auto-approbation
        return $company->website !== null &&
               $company->phone !== null &&
               $company->team_size >= 5 &&
               str_contains($company->email, $this->extractDomainFromWebsite($company->website));
    }

    private function extractDomainFromWebsite(string $website): string
    {
        return parse_url($website, PHP_URL_HOST) ?? '';
    }

    private function approveRegistration(CompanyRegistration $registration): void
    {
        $registration->update(['status' => 'approved']);
        $registration->company->update(['status' => 'active']);
        
        // Notification de bienvenue
        $registration->company->notify(new WelcomeNotification($registration));
    }

    private function processHiringRegistration(CompanyRegistration $registration): void
    {
        // Logique spécifique au recrutement
        if ($registration->has_international_projects) {
            // Ajouter des privilèges spéciaux
            $registration->update([
                'data' => array_merge($registration->data ?? [], [
                    'priority_access' => true,
                    'international_badge' => true
                ])
            ]);
        }
    }

    private function processPartnershipRegistration(CompanyRegistration $registration): void
    {
        // Créer un partenariat potentiel
        if ($registration->status === 'approved') {
            Partnership::create([
                'company_id' => $registration->company_id,
                'type' => $registration->partnership_type,
                'duration' => $registration->partnership_duration,
                'services' => $registration->services_needed,
                'budget' => $registration->budget_range,
                'status' => 'pending',
                'description' => $registration->collaboration_expectations,
            ]);
        }
    }

    private function processOfferSenderRegistration(CompanyRegistration $registration): void
    {
        // Auto-publier les offres si l'entreprise est approuvée
        if ($registration->status === 'approved') {
            InternshipOffer::where('company_id', $registration->company_id)
                ->where('status', 'draft')
                ->update([
                    'status' => 'published',
                    'published_at' => now()
                ]);
        }
    }
}