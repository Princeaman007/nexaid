<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Carbon\Carbon;

class Internship extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'category_id',
        'company_name',
        'image',
        'is_active',
        // Informations de base
        'duration',              // Durée du stage (ex: "3-6 months")
        'start_date',            // Date de début (peut être une date fixe ou "Flexible")
        'compensation',          // Rémunération (montant ou description)
        'position_type',         // Type de poste (temps plein, temps partiel)
        'remote_option',         // Possibilité de télétravail (oui/non/hybride)
        'internship_level',      // Niveau de stage (débutant, intermédiaire, avancé)
        'application_deadline',  // Date limite de candidature
        'is_featured',           // Stage mis en avant sur la page d'accueil
        // Mission et compétences (format Internship Makers)
        'main_responsibilities', // Responsabilités principales (JSON)
        'required_skills',       // Compétences requises (JSON)
        'required_language',     // Langue(s) requise(s)
        'qualifications',        // Qualifications requises (diplôme, etc.) (JSON)
        'learning_outcomes',     // Ce que le stagiaire va apprendre (JSON)
        'benefits',              // Avantages offerts (JSON)
        // Informations supplémentaires
        'company_description',   // Description de l'entreprise (pour context)
        'application_process',   // Description du processus de candidature
        'contact_email',         // Email de contact pour questions
        'contact_phone',         // Téléphone de contact
    ];

    public $translatable = [
        'title', 
        'description', 
        'main_responsibilities',
        'learning_outcomes', 
        'required_skills',
        'qualifications',
        'benefits',
        'company_description',
        'application_process'
    ];

    // Assurez-vous que les dates sont correctement gérées comme des objets Carbon
    protected $dates = [
        'start_date',
        'application_deadline',
        'created_at',
        'updated_at'
    ];

    // Assurez-vous que les champs JSON sont correctement traités
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'remote_option' => 'string',
        'main_responsibilities' => 'array',
        'required_skills' => 'array',
        'qualifications' => 'array',
        'learning_outcomes' => 'array',
        'benefits' => 'array',
    ];
    
    // Accesseur pour s'assurer que application_deadline est toujours un Carbon
    public function getApplicationDeadlineAttribute($value)
    {
        if ($value && !$value instanceof Carbon) {
            return Carbon::parse($value);
        }
        
        return $value;
    }
    
    // Accesseur pour s'assurer que start_date est toujours un Carbon
    public function getStartDateAttribute($value)
    {
        if ($value && !$value instanceof Carbon) {
            return Carbon::parse($value);
        }
        
        return $value;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Ajout d'une relation avec les candidatures
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    // Méthodes utilitaires
    
    // Vérifier si la date limite de candidature est dépassée
    public function isExpired()
    {
        if (!$this->application_deadline) {
            return false;
        }
        
        return now()->greaterThan($this->application_deadline);
    }
    
    // Récupérer les stages similaires (même catégorie)
    public function relatedInternships($limit = 3)
    {
        return self::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->where('is_active', true)
            ->latest()
            ->take($limit)
            ->get();
    }
    
    // Récupérer les stages avec le même lieu
    public function internshipsInSameLocation($limit = 3)
    {
        return self::where('location', $this->location)
            ->where('id', '!=', $this->id)
            ->where('is_active', true)
            ->latest()
            ->take($limit)
            ->get();
    }
    
    // Formater la durée pour l'affichage
    public function formattedDuration()
    {
        return $this->duration ?: 'To be discussed';
    }
    
    // Obtenir l'URL complète de l'image
    public function getImageUrl()
    {
        if (!$this->image) {
            return null;
        }
        
        return asset('storage/' . $this->image);
    }
    
    // Obtenir un résumé court de la description (pour les cartes)
    public function getShortDescription($limit = 100)
    {
        $description = strip_tags($this->getTranslation('description', app()->getLocale(), false));
        
        if (strlen($description) <= $limit) {
            return $description;
        }
        
        return substr($description, 0, $limit) . '...';
    }
    
    // Vérifier si le stage est récent (moins de 7 jours)
    public function isNew()
    {
        return $this->created_at->diffInDays(now()) < 7;
    }
    
    // Vérifier si le stage est urgent (deadline moins de 14 jours)
    public function isUrgent()
    {
        if (!$this->application_deadline) {
            return false;
        }
        
        return $this->application_deadline->diffInDays(now()) < 14 && !$this->isExpired();
    }
}