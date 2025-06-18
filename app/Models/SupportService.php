<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SupportService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'service_slug',
        'description',
        'detailed_description',
        'administrative_assistance',
        'professional_support',
        'personal_support',
        'social_activities',
        'administrative_services',
        'visa_assistance',
        'residence_permit_help',
        'bank_account_assistance',
        'local_registration_help',
        'health_insurance_guidance',
        'document_translation',
        'professional_services',
        'company_mediation',
        'corporate_culture_advice',
        'internship_difficulty_support',
        'professional_guidance',
        'cv_linkedin_optimization',
        'interview_preparation',
        'personal_services',
        'cultural_integration_help',
        'local_life_recommendations',
        'medical_assistance',
        'personal_difficulties_support',
        'mental_health_support',
        'emergency_assistance',
        'social_activities_offered',
        'networking_events',
        'intern_meetups',
        'cultural_outings',
        'team_building_activities',
        'monthly_events_count',
        'events_average_cost',
        'has_24_7_helpline',
        'emergency_phone',
        'support_email',
        'email_support_available',
        'email_response_hours',
        'personal_appointments',
        'video_appointments',
        'mobile_app_available',
        'live_chat_support',
        'whatsapp_support',
        'urgent_response_hours',
        'personalized_advisor',
        'confidential_handling',
        'concrete_solutions_commitment',
        'service_guarantees',
        'covered_cities',
        'supported_languages',
        'operates_weekends',
        'operates_holidays',
        'regular_hours_start',
        'regular_hours_end',
        'advisors_count',
        'team_average_experience_years',
        'team_specializations',
        'multilingual_team',
        'online_resource_library',
        'city_guides_available',
        'document_templates',
        'emergency_contacts_database',
        'mobile_app_store_url',
        'resource_portal_url',
        'service_satisfaction_rating',
        'total_cases_handled',
        'resolution_success_rate',
        'average_resolution_hours',
        'testimonials',
        'monthly_subscription_price',
        'included_in_internship_package',
        'pay_per_use_available',
        'consultation_hourly_rate',
        'premium_features',
        'housing_integration',
        'internship_integration',
        'airport_pickup_coordination',
        'company_liaison',
        'crisis_intervention_available',
        'emergency_protocols',
        'local_emergency_contacts',
        'family_notification_service',
        'legal_assistance_referral',
        'monthly_progress_reports',
        'case_tracking_system',
        'satisfaction_surveys',
        'survey_frequency_days',
        'is_active',
        'is_featured',
        'accepting_new_clients',
        'current_capacity_percentage',
        'sort_order',
        'admin_notes',
    ];

    protected $casts = [
        'administrative_services' => 'array',
        'professional_services' => 'array',
        'personal_services' => 'array',
        'social_activities_offered' => 'array',
        'covered_cities' => 'array',
        'supported_languages' => 'array',
        'team_specializations' => 'array',
        'testimonials' => 'array',
        'premium_features' => 'array',
        'emergency_protocols' => 'array',
        'administrative_assistance' => 'boolean',
        'professional_support' => 'boolean',
        'personal_support' => 'boolean',
        'social_activities' => 'boolean',
        'visa_assistance' => 'boolean',
        'residence_permit_help' => 'boolean',
        'bank_account_assistance' => 'boolean',
        'local_registration_help' => 'boolean',
        'health_insurance_guidance' => 'boolean',
        'document_translation' => 'boolean',
        'company_mediation' => 'boolean',
        'corporate_culture_advice' => 'boolean',
        'internship_difficulty_support' => 'boolean',
        'professional_guidance' => 'boolean',
        'cv_linkedin_optimization' => 'boolean',
        'interview_preparation' => 'boolean',
        'cultural_integration_help' => 'boolean',
        'local_life_recommendations' => 'boolean',
        'medical_assistance' => 'boolean',
        'personal_difficulties_support' => 'boolean',
        'mental_health_support' => 'boolean',
        'emergency_assistance' => 'boolean',
        'networking_events' => 'boolean',
        'intern_meetups' => 'boolean',
        'cultural_outings' => 'boolean',
        'team_building_activities' => 'boolean',
        'has_24_7_helpline' => 'boolean',
        'email_support_available' => 'boolean',
        'personal_appointments' => 'boolean',
        'video_appointments' => 'boolean',
        'mobile_app_available' => 'boolean',
        'live_chat_support' => 'boolean',
        'personalized_advisor' => 'boolean',
        'confidential_handling' => 'boolean',
        'concrete_solutions_commitment' => 'boolean',
        'operates_weekends' => 'boolean',
        'operates_holidays' => 'boolean',
        'multilingual_team' => 'boolean',
        'online_resource_library' => 'boolean',
        'city_guides_available' => 'boolean',
        'document_templates' => 'boolean',
        'emergency_contacts_database' => 'boolean',
        'included_in_internship_package' => 'boolean',
        'pay_per_use_available' => 'boolean',
        'housing_integration' => 'boolean',
        'internship_integration' => 'boolean',
        'airport_pickup_coordination' => 'boolean',
        'company_liaison' => 'boolean',
        'crisis_intervention_available' => 'boolean',
        'family_notification_service' => 'boolean',
        'legal_assistance_referral' => 'boolean',
        'monthly_progress_reports' => 'boolean',
        'case_tracking_system' => 'boolean',
        'satisfaction_surveys' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'accepting_new_clients' => 'boolean',
        'events_average_cost' => 'decimal:2',
        'team_average_experience_years' => 'decimal:1',
        'service_satisfaction_rating' => 'decimal:2',
        'resolution_success_rate' => 'decimal:2',
        'monthly_subscription_price' => 'decimal:2',
        'consultation_hourly_rate' => 'decimal:2',
        'regular_hours_start' => 'datetime:H:i:s',
        'regular_hours_end' => 'datetime:H:i:s',
    ];

    // Constants for support categories
    const CATEGORY_ADMINISTRATIVE = 'administrative';
    const CATEGORY_PROFESSIONAL = 'professional';
    const CATEGORY_PERSONAL = 'personal';
    const CATEGORY_SOCIAL = 'social';

    // Relation polymorphe avec la table services principale
    public function service()
    {
        return $this->morphOne(Service::class, 'serviceable');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAcceptingClients($query)
    {
        return $query->where('accepting_new_clients', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCity($query, $city)
    {
        return $query->whereJsonContains('covered_cities', $city);
    }

    public function scopeByLanguage($query, $language)
    {
        return $query->whereJsonContains('supported_languages', $language);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('service_satisfaction_rating', 'desc');
    }

    // Accesseurs
    public function getServiceRatingStarsAttribute()
    {
        return str_repeat('★', floor($this->service_satisfaction_rating)) . 
               str_repeat('☆', 5 - floor($this->service_satisfaction_rating));
    }

    public function getSupportedLanguagesListAttribute()
    {
        return collect($this->supported_languages)->join(', ');
    }

    public function getCoveredCitiesListAttribute()
    {
        return collect($this->covered_cities)->join(', ');
    }

    public function getFormattedResponseTimeAttribute()
    {
        return $this->urgent_response_hours === 1 ? 
               '1 hour' : 
               $this->urgent_response_hours . ' hours';
    }

    public function getFormattedResolutionRateAttribute()
    {
        return number_format($this->resolution_success_rate, 1) . '%';
    }

    public function getCapacityStatusAttribute()
    {
        if ($this->current_capacity_percentage >= 95) {
            return 'Full';
        } elseif ($this->current_capacity_percentage >= 80) {
            return 'High Demand';
        } elseif ($this->current_capacity_percentage >= 50) {
            return 'Available';
        }
        return 'Low Demand';
    }

    public function getCapacityStatusColorAttribute()
    {
        return match($this->capacity_status) {
            'Full' => 'red',
            'High Demand' => 'orange',
            'Available' => 'green',
            'Low Demand' => 'blue',
            default => 'gray'
        };
    }

    // Méthodes utilitaires
    public function isAvailableInCity($city)
    {
        return in_array($city, $this->covered_cities ?? []);
    }

    public function supportsLanguage($language)
    {
        return in_array($language, $this->supported_languages ?? []);
    }

    public function isCurrentlyOpen()
    {
        if ($this->has_24_7_helpline) {
            return true;
        }

        $now = Carbon::now();
        $startTime = Carbon::parse($this->regular_hours_start);
        $endTime = Carbon::parse($this->regular_hours_end);

        // Check if it's weekend and service operates on weekends
        if ($now->isWeekend() && !$this->operates_weekends) {
            return false;
        }

        return $now->between($startTime, $endTime);
    }

    public function getSupportCategories()
    {
        $categories = [];
        
        if ($this->administrative_assistance) {
            $categories[] = [
                'name' => 'Administrative Assistance',
                'slug' => self::CATEGORY_ADMINISTRATIVE,
                'services' => $this->getAdministrativeServices()
            ];
        }
        
        if ($this->professional_support) {
            $categories[] = [
                'name' => 'Professional Support',
                'slug' => self::CATEGORY_PROFESSIONAL,
                'services' => $this->getProfessionalServices()
            ];
        }
        
        if ($this->personal_support) {
            $categories[] = [
                'name' => 'Personal Support',
                'slug' => self::CATEGORY_PERSONAL,
                'services' => $this->getPersonalServices()
            ];
        }
        
        if ($this->social_activities) {
            $categories[] = [
                'name' => 'Social Activities',
                'slug' => self::CATEGORY_SOCIAL,
                'services' => $this->getSocialServices()
            ];
        }
        
        return $categories;
    }

    private function getAdministrativeServices()
    {
        $services = [];
        if ($this->visa_assistance) $services[] = 'Visa assistance';
        if ($this->residence_permit_help) $services[] = 'Residence permit help';
        if ($this->bank_account_assistance) $services[] = 'Bank account opening';
        if ($this->local_registration_help) $services[] = 'Local registration';
        if ($this->health_insurance_guidance) $services[] = 'Health insurance guidance';
        if ($this->document_translation) $services[] = 'Document translation';
        return $services;
    }

    private function getProfessionalServices()
    {
        $services = [];
        if ($this->company_mediation) $services[] = 'Company mediation';
        if ($this->corporate_culture_advice) $services[] = 'Corporate culture advice';
        if ($this->internship_difficulty_support) $services[] = 'Internship difficulty support';
        if ($this->professional_guidance) $services[] = 'Professional guidance';
        if ($this->cv_linkedin_optimization) $services[] = 'CV/LinkedIn optimization';
        if ($this->interview_preparation) $services[] = 'Interview preparation';
        return $services;
    }

    private function getPersonalServices()
    {
        $services = [];
        if ($this->cultural_integration_help) $services[] = 'Cultural integration help';
        if ($this->local_life_recommendations) $services[] = 'Local life recommendations';
        if ($this->medical_assistance) $services[] = 'Medical assistance';
        if ($this->personal_difficulties_support) $services[] = 'Personal difficulties support';
        if ($this->mental_health_support) $services[] = 'Mental health support';
        if ($this->emergency_assistance) $services[] = 'Emergency assistance';
        return $services;
    }

    private function getSocialServices()
    {
        $services = [];
        if ($this->networking_events) $services[] = 'Networking events';
        if ($this->intern_meetups) $services[] = 'Intern meetups';
        if ($this->cultural_outings) $services[] = 'Cultural outings';
        if ($this->team_building_activities) $services[] = 'Team building activities';
        return $services;
    }

    public function getContactMethods()
    {
        $methods = [];
        
        if ($this->has_24_7_helpline && $this->emergency_phone) {
            $methods[] = [
                'type' => 'Emergency Phone',
                'value' => $this->emergency_phone,
                'available' => '24/7',
                'urgency' => 'urgent'
            ];
        }
        
        if ($this->email_support_available && $this->support_email) {
            $methods[] = [
                'type' => 'Email Support',
                'value' => $this->support_email,
                'available' => 'Response within ' . $this->email_response_hours . ' hours',
                'urgency' => 'normal'
            ];
        }
        
        if ($this->whatsapp_support) {
            $methods[] = [
                'type' => 'WhatsApp',
                'value' => $this->whatsapp_support,
                'available' => 'Business hours',
                'urgency' => 'normal'
            ];
        }
        
        if ($this->personal_appointments) {
            $methods[] = [
                'type' => 'Personal Appointment',
                'value' => 'Book via phone or email',
                'available' => 'Business hours',
                'urgency' => 'scheduled'
            ];
        }
        
        return $methods;
    }

    public function canAcceptNewClients()
    {
        return $this->is_active && 
               $this->accepting_new_clients && 
               $this->current_capacity_percentage < 100;
    }

    public function getRandomTestimonial()
    {
        if (!$this->testimonials || count($this->testimonials) === 0) {
            return null;
        }
        
        return $this->testimonials[array_rand($this->testimonials)];
    }
}