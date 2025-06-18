<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipSearchService extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_name',
        'package_slug',
        'price',
        'description',
        'profile_analysis',
        'application_count',
        'cv_optimization',
        'cover_letter_optimization',
        'unlimited_followup',
        'direct_company_connection',
        'personalized_advisor',
        'has_guarantee',
        'guarantee_duration_months',
        'guarantee_refund_percentage',
        'guarantee_conditions',
        'supported_sectors',
        'supported_languages',
        'covered_countries',
        'partner_companies_count',
        'success_rate_percentage',
        'average_placement_days',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'profile_analysis' => 'boolean',
        'cv_optimization' => 'boolean',
        'cover_letter_optimization' => 'boolean',
        'unlimited_followup' => 'boolean',
        'direct_company_connection' => 'boolean',
        'personalized_advisor' => 'boolean',
        'has_guarantee' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'supported_sectors' => 'array',
        'supported_languages' => 'array',
        'covered_countries' => 'array',
        'price' => 'decimal:2',
    ];

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

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('price');
    }

    // Accesseurs
    public function getFormattedPriceAttribute()
    {
        return '€' . number_format($this->price, 0);
    }

    public function getApplicationCountTextAttribute()
    {
        return $this->application_count === -1 ? 'Unlimited' : $this->application_count;
    }

    public function getGuaranteeTextAttribute()
    {
        if (!$this->has_guarantee) {
            return null;
        }

        return "If no internship found after {$this->guarantee_duration_months} months, {$this->guarantee_refund_percentage}% refund";
    }

    // Méthodes utilitaires
    public function isBasic()
    {
        return $this->package_slug === 'basic';
    }

    public function isPremium()
    {
        return $this->package_slug === 'premium';
    }

    public function isSuccess()
    {
        return $this->package_slug === 'success';
    }

    public function hasUnlimitedApplications()
    {
        return $this->application_count === -1;
    }

    public function getSupportedSectorsListAttribute()
    {
        return collect($this->supported_sectors)->map(function ($sector) {
            return is_array($sector) ? $sector['name'] : $sector;
        })->join(', ');
    }
}