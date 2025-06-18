<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'base_price',
        'is_active',
        'serviceable_type',
        'serviceable_id',
        // Garder les anciens champs pour compatibilité si nécessaire
        'title',
        'subtitle',
        'how_it_works',
        'advantages',
        'testimonials',
        'icon',
        'hero_image',
        'gallery',
        'background_color',
        'features',
        'pricing',
        'faq',
        'contact_email',
        'contact_phone',
        'meta_title',
        'meta_description',
        'call_to_action',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'base_price' => 'decimal:2',
        // Anciens champs multilingues (pour compatibilité)
        'title' => 'array',
        'subtitle' => 'array',
        'description' => 'array',
        'how_it_works' => 'array',
        'advantages' => 'array',
        'testimonials' => 'array',
        'gallery' => 'array',
        'features' => 'array',
        'pricing' => 'array',
        'faq' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
        'call_to_action' => 'array',
    ];

    // Les 4 types de services
    const TYPES = [
        'internship-search' => [
            'fr' => 'Recherche de Stage',
            'en' => 'Internship Search'
        ],
        'housing' => [
            'fr' => 'Logement',
            'en' => 'Housing'
        ],
        'airport-pickup' => [
            'fr' => 'Transport Aéroport',
            'en' => 'Airport Pickup'
        ],
        'support' => [
            'fr' => 'Support',
            'en' => 'Support'
        ]
    ];

    // Relation polymorphe vers les services spécifiques
    public function serviceable()
    {
        return $this->morphTo();
    }

    // Relations inverses pour chaque type de service
    public function internshipSearchServices()
    {
        return $this->morphedByMany(InternshipSearchService::class, 'serviceable');
    }

    public function housingServices()
    {
        return $this->morphedByMany(HousingService::class, 'serviceable');
    }

    public function airportPickupServices()
    {
        return $this->morphedByMany(AirportPickupService::class, 'serviceable');
    }

    public function supportServices()
    {
        return $this->morphedByMany(SupportService::class, 'serviceable');
    }

    // Scope pour les services actifs
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Obtenir le titre traduit (backward compatibility)
    public function getTranslation(string $field, string $locale = null): string
    {
        $locale = $locale ?: app()->getLocale();
        $translations = $this->getAttribute($field);
        
        if (is_array($translations)) {
            return $translations[$locale] ?? $translations['fr'] ?? $translations['en'] ?? '';
        }
        
        return $translations ?? '';
    }

    // Obtenir le nom du type traduit
    public function getTypeNameAttribute()
    {
        return self::TYPES[$this->type][app()->getLocale()] ?? $this->type;
    }

    // Obtenir l'URL du service
    public function getRouteAttribute()
    {
        // Convertir les tirets en underscores pour les noms de routes si nécessaire
        $routeName = str_replace('-', '_', $this->type);
        return "services.{$routeName}";
    }

    // Obtenir l'URL complète
    public function getUrlAttribute()
    {
        return route("services.{$this->type}");
    }

    // Obtenir l'image hero
    public function getHeroImageUrlAttribute()
    {
        return $this->hero_image ? asset('storage/' . $this->hero_image) : null;
    }

    // Obtenir la galerie d'images
    public function getGalleryUrlsAttribute()
    {
        if (!$this->gallery) return [];
        
        return collect($this->gallery)->map(function ($image) {
            return asset('storage/' . $image);
        })->toArray();
    }

    // Obtenir le prix formaté
    public function getFormattedPriceAttribute()
    {
        if (!$this->base_price) return null;
        return '€' . number_format($this->base_price, 0);
    }

    // Vérifier si le service a des données spécifiques
    public function hasServiceableData()
    {
        return $this->serviceable !== null;
    }

    // Obtenir toutes les données du service (général + spécifique)
    public function getFullServiceData()
    {
        $data = $this->toArray();
        
        if ($this->serviceable) {
            $data['specific_data'] = $this->serviceable->toArray();
        }
        
        return $data;
    }

    // Méthodes pour récupérer chaque type de service avec leurs données spécifiques
    public static function getInternshipSearch()
    {
        return self::where('type', 'internship-search')
                   ->with('serviceable')
                   ->active()
                   ->first();
    }

    public static function getHousing()
    {
        return self::where('type', 'housing')
                   ->with('serviceable')
                   ->active()
                   ->first();
    }

    public static function getAirportPickup()
    {
        return self::where('type', 'airport-pickup')
                   ->with('serviceable')
                   ->active()
                   ->first();
    }

    public static function getSupport()
    {
        return self::where('type', 'support')
                   ->with('serviceable')
                   ->active()
                   ->first();
    }

    // Nouvelles méthodes pour récupérer toutes les variantes d'un service
    public static function getAllInternshipSearchPackages()
    {
        return InternshipSearchService::active()
                ->ordered()
                ->get()
                ->map(function ($package) {
                    return (object) [
                        'service' => self::getInternshipSearch(),
                        'package' => $package
                    ];
                });
    }

    public static function getAllHousingOptions()
    {
        return HousingService::active()
                ->available()
                ->ordered()
                ->get()
                ->map(function ($housing) {
                    return (object) [
                        'service' => self::getHousing(),
                        'housing' => $housing
                    ];
                });
    }

    public static function getAllAirportPickupOptions()
    {
        return AirportPickupService::active()
                ->acceptingBookings()
                ->ordered()
                ->get()
                ->map(function ($pickup) {
                    return (object) [
                        'service' => self::getAirportPickup(),
                        'pickup' => $pickup
                    ];
                });
    }

    public static function getAllSupportOptions()
    {
        return SupportService::active()
                ->acceptingClients()
                ->ordered()
                ->get()
                ->map(function ($support) {
                    return (object) [
                        'service' => self::getSupport(),
                        'support' => $support
                    ];
                });
    }

    // Méthode utilitaire pour obtenir le service spécifique par type et ID
    public static function getSpecificService($type, $id = null)
    {
        $service = self::where('type', $type)->active()->first();
        
        if (!$service) return null;

        if ($id) {
            // Récupérer une variante spécifique
            switch ($type) {
                case 'internship-search':
                    $specific = InternshipSearchService::find($id);
                    break;
                case 'housing':
                    $specific = HousingService::find($id);
                    break;
                case 'airport-pickup':
                    $specific = AirportPickupService::find($id);
                    break;
                case 'support':
                    $specific = SupportService::find($id);
                    break;
                default:
                    $specific = null;
            }

            return $specific ? (object) ['service' => $service, 'specific' => $specific] : null;
        }

        return $service;
    }

    // Méthode pour obtenir les statistiques du service
    public function getServiceStats()
    {
        $stats = [];
        
        switch ($this->type) {
            case 'internship-search':
                $packages = InternshipSearchService::active()->get();
                $stats = [
                    'total_packages' => $packages->count(),
                    'price_range' => [
                        'min' => $packages->min('price'),
                        'max' => $packages->max('price')
                    ],
                    'success_rate' => $packages->first()->success_rate_percentage ?? 0,
                ];
                break;
                
            case 'housing':
                $housings = HousingService::active()->get();
                $stats = [
                    'total_properties' => $housings->count(),
                    'available_properties' => $housings->where('currently_available', true)->count(),
                    'price_range' => [
                        'min' => $housings->min('starting_price_monthly'),
                        'max' => $housings->max('starting_price_monthly')
                    ],
                    'cities_count' => $housings->pluck('city')->unique()->count(),
                ];
                break;
                
            case 'airport-pickup':
                $pickups = AirportPickupService::active()->get();
                $stats = [
                    'airports_served' => $pickups->count(),
                    'price_range' => [
                        'min' => $pickups->min('base_price_0_20km'),
                        'max' => $pickups->max('base_price_41_60km')
                    ],
                    'average_rating' => $pickups->avg('service_rating'),
                    'total_transfers' => $pickups->sum('total_transfers_completed'),
                ];
                break;
                
            case 'support':
                $supports = SupportService::active()->get();
                $stats = [
                    'support_options' => $supports->count(),
                    'cities_covered' => $supports->first()->covered_cities ?? [],
                    'languages_supported' => $supports->first()->supported_languages ?? [],
                    'average_satisfaction' => $supports->avg('service_satisfaction_rating'),
                ];
                break;
        }
        
        return $stats;
    }
}