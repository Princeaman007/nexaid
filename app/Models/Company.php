<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'website',
        'description',
        'logo',
        'type',
        
        // Hiring type fields
        'sectors_interested',
        'languages_needed',
        'intern_duration_preference',
        'team_size',
        'has_international_projects',
        'cultural_diversity_goals',
        
        // Partnership type fields
        'partnership_type',
        'collaboration_expectations',
        'services_needed',
        'partnership_duration',
        'budget_range',
        'long_term_partnership',
        
        // Offer sender type fields
        'offer_title',
        'offer_description',
        'required_skills',
        'offer_location',
        'remote_possible',
        'offer_start_date',
        'offer_end_date',
        'salary_amount',
        'offer_status',
        
        'is_active',
        'verified_at',
    ];

    protected $casts = [
        'sectors_interested' => 'array',
        'languages_needed' => 'array',
        'services_needed' => 'array',
        'required_skills' => 'array',
        'has_international_projects' => 'boolean',
        'long_term_partnership' => 'boolean',
        'remote_possible' => 'boolean',
        'is_active' => 'boolean',
        'offer_start_date' => 'date',
        'offer_end_date' => 'date',
        'verified_at' => 'datetime',
        'budget_range' => 'decimal:2',
        'salary_amount' => 'decimal:2',
    ];

    // Constantes pour les types
    const TYPE_HIRING = 'hiring';
    const TYPE_PARTNERSHIP = 'partnership';
    const TYPE_OFFER_SENDER = 'offer_sender';

    const TYPES = [
        self::TYPE_HIRING => 'Cherche à embaucher des stagiaires',
        self::TYPE_PARTNERSHIP => 'Partenariat avec la plateforme',
        self::TYPE_OFFER_SENDER => 'Envoie des offres de stage',
    ];

    // Constantes pour les statuts d'offre
    const OFFER_STATUS_DRAFT = 'draft';
    const OFFER_STATUS_ACTIVE = 'active';
    const OFFER_STATUS_EXPIRED = 'expired';

    const OFFER_STATUSES = [
        self::OFFER_STATUS_DRAFT => 'Brouillon',
        self::OFFER_STATUS_ACTIVE => 'Active',
        self::OFFER_STATUS_EXPIRED => 'Expirée',
    ];

    // Scopes
    public function scopeHiring(Builder $query): Builder
    {
        return $query->where('type', self::TYPE_HIRING);
    }

    public function scopePartnership(Builder $query): Builder
    {
        return $query->where('type', self::TYPE_PARTNERSHIP);
    }

    public function scopeOfferSender(Builder $query): Builder
    {
        return $query->where('type', self::TYPE_OFFER_SENDER);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeVerified(Builder $query): Builder
    {
        return $query->whereNotNull('verified_at');
    }

    // Accessors
    public function getTypeNameAttribute(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    public function getOfferStatusNameAttribute(): string
    {
        return self::OFFER_STATUSES[$this->offer_status] ?? $this->offer_status;
    }

    // Méthodes utiles
    public function isHiring(): bool
    {
        return $this->type === self::TYPE_HIRING;
    }

    public function isPartnership(): bool
    {
        return $this->type === self::TYPE_PARTNERSHIP;
    }

    public function isOfferSender(): bool
    {
        return $this->type === self::TYPE_OFFER_SENDER;
    }

    public function isVerified(): bool
    {
        return !is_null($this->verified_at);
    }

    public function markAsVerified(): void
    {
        $this->update(['verified_at' => now()]);
    }
}