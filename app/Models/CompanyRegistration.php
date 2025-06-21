<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'type',
        'sectors_interested',
        'languages_needed',
        'intern_duration_preference',
        'has_international_projects',
        'cultural_diversity_goals',
        'services_needed',
        'partnership_type',
        'partnership_duration',
        'budget_range',
        'long_term_partnership',
        'collaboration_expectations',
        'status',
        'data'
    ];

    protected $casts = [
        'sectors_interested' => 'array',
        'languages_needed' => 'array',
        'services_needed' => 'array',
        'has_international_projects' => 'boolean',
        'long_term_partnership' => 'boolean',
        'budget_range' => 'decimal:2',
        'data' => 'array',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getTypeLabel(): string
    {
        return match($this->type) {
            'hiring' => 'Recrutement',
            'partnership' => 'Partenariat',
            'offer_sender' => 'Publication d\'offre',
            default => 'Autre'
        };
    }
}