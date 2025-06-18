<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Carbon\Carbon;

class Internship extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'main_responsibilities',
        'duration',
        'start_date',
        'compensation',
        'required_language',
        'required_skills',
        'qualifications',
        'learning_outcomes',
        'application_deadline',
        'position_type',
        'remote_option',
        'internship_level',
        'benefits',
        'application_process',
        'contact_email',
        'contact_phone',
        'location',
        'category_id',
        'company_name',
        'company_description',
        'image',
        'is_active',
        'is_featured',
    ];

    public $translatable = [
        'title',
        'description',
        'main_responsibilities',
        'required_skills',
        'qualifications',
        'learning_outcomes',
        'benefits',
        'application_process',
        'company_description'
    ];

    protected $casts = [
        'start_date' => 'date',
        'application_deadline' => 'date',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Relation avec la catégorie
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relation avec les candidatures
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Vérifier si le stage est expiré
     */
    public function isExpired(): bool
    {
        if (!$this->application_deadline) {
            return false;
        }

        return Carbon::parse($this->application_deadline)->isPast();
    }

    /**
     * Obtenir les stages similaires
     */
    public function relatedInternships(int $limit = 3)
    {
        return static::where('category_id', $this->category_id)
                    ->where('id', '!=', $this->id)
                    ->where('is_active', true)
                    ->inRandomOrder()
                    ->limit($limit)
                    ->get();
    }

    /**
     * Scope pour les stages actifs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour les stages en vedette
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Obtenir le nombre de candidatures
     */
    public function getApplicationsCountAttribute(): int
    {
        return $this->applications()->count();
    }

    /**
     * Obtenir le nombre de candidatures récentes (dernières 24h)
     */
    public function getRecentApplicationsCountAttribute(): int
    {
        return $this->applications()
                   ->where('applied_at', '>=', now()->subDay())
                   ->count();
    }
}