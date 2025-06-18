<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HousingService extends Model
{
    use HasFactory;

    protected $fillable = [
        'housing_type', 'housing_name', 'housing_slug', 'description', 'detailed_description',
        'starting_price_monthly', 'deposit_amount', 'agency_fees', 'additional_costs',
        'city', 'country', 'district', 'address', 'latitude', 'longitude',
        'room_count', 'bathroom_count', 'surface_area_sqm', 'furnished', 'max_occupants', 'suitable_for_couples',
        'amenities', 'shared_facilities', 'utilities_included', 'included_utilities', 'cleaning_service', 'security_system',
        'min_stay_months', 'max_stay_months', 'flexible_contracts', 'available_from', 'currently_available',
        'host_family_info', 'meals_included', 'meal_plan',
        'transport_options', 'distance_to_city_center_km', 'neighborhood_description',
        'quality_inspected', 'quality_rating', 'inspection_photos', 'last_inspection_date',
        'has_24_7_support', 'welcome_service', 'installation_assistance', 'maintenance_included',
        'photos', 'virtual_tour_urls', 'required_documents',
        'testimonials', 'average_rating', 'total_bookings',
        'contact_email', 'contact_phone', 'booking_instructions', 'instant_booking',
        'is_active', 'is_featured', 'verified_listing', 'sort_order', 'admin_notes'
    ];

    protected $casts = [
        'additional_costs' => 'array',
        'amenities' => 'array',
        'shared_facilities' => 'array',
        'included_utilities' => 'array',
        'host_family_info' => 'array',
        'transport_options' => 'array',
        'inspection_photos' => 'array',
        'photos' => 'array',
        'virtual_tour_urls' => 'array',
        'required_documents' => 'array',
        'testimonials' => 'array',
        'furnished' => 'boolean',
        'suitable_for_couples' => 'boolean',
        'utilities_included' => 'boolean',
        'cleaning_service' => 'boolean',
        'security_system' => 'boolean',
        'flexible_contracts' => 'boolean',
        'currently_available' => 'boolean',
        'meals_included' => 'boolean',
        'quality_inspected' => 'boolean',
        'has_24_7_support' => 'boolean',
        'welcome_service' => 'boolean',
        'installation_assistance' => 'boolean',
        'maintenance_included' => 'boolean',
        'instant_booking' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'verified_listing' => 'boolean',
        'available_from' => 'date',
        'last_inspection_date' => 'date',
        'starting_price_monthly' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'agency_fees' => 'decimal:2',
        'surface_area_sqm' => 'decimal:2',
        'distance_to_city_center_km' => 'decimal:2',
        'quality_rating' => 'decimal:2',
        'average_rating' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Constantes pour les types de logement
    const TYPE_STUDENT_RESIDENCE = 'student_residence';
    const TYPE_SHARED_APARTMENT = 'shared_apartment';
    const TYPE_HOST_FAMILY = 'host_family';
    const TYPE_PRIVATE_STUDIO = 'private_studio';

    const TYPES = [
        self::TYPE_STUDENT_RESIDENCE => 'Résidence étudiante',
        self::TYPE_SHARED_APARTMENT => 'Colocation',
        self::TYPE_HOST_FAMILY => 'Famille d\'accueil',
        self::TYPE_PRIVATE_STUDIO => 'Studio privé',
    ];

    // Constantes pour les plans de repas
    const MEAL_BREAKFAST = 'breakfast';
    const MEAL_HALF_BOARD = 'half_board';
    const MEAL_FULL_BOARD = 'full_board';
    const MEAL_BREAKFAST_DINNER = 'breakfast_dinner';

    const MEAL_PLANS = [
        self::MEAL_BREAKFAST => 'Petit-déjeuner seulement',
        self::MEAL_HALF_BOARD => 'Demi-pension',
        self::MEAL_FULL_BOARD => 'Pension complète',
        self::MEAL_BREAKFAST_DINNER => 'Petit-déjeuner et dîner',
    ];

    // Relation polymorphe avec Service
    public function service()
    {
        return $this->morphOne(Service::class, 'serviceable');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAvailable($query)
    {
        return $query->where('currently_available', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')
                     ->orderBy('quality_rating', 'desc')
                     ->orderBy('starting_price_monthly');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('housing_type', $type);
    }

    public function scopeByCity($query, $city)
    {
        return $query->where('city', $city);
    }

    public function scopeByPriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('starting_price_monthly', [$minPrice, $maxPrice]);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeVerified($query)
    {
        return $query->where('verified_listing', true);
    }

    public function scopeForCouples($query)
    {
        return $query->where('suitable_for_couples', true);
    }

    public function scopeFurnished($query)
    {
        return $query->where('furnished', true);
    }

    // Accessors
    public function getTypeNameAttribute()
    {
        return self::TYPES[$this->housing_type] ?? $this->housing_type;
    }

    public function getMealPlanNameAttribute()
    {
        return $this->meal_plan ? (self::MEAL_PLANS[$this->meal_plan] ?? $this->meal_plan) : null;
    }

    public function getFormattedPriceAttribute()
    {
        return '€' . number_format($this->starting_price_monthly, 0) . '/mois';
    }

    public function getTotalMonthlyCostAttribute()
    {
        $total = $this->starting_price_monthly;
        
        if ($this->additional_costs) {
            foreach ($this->additional_costs as $cost) {
                $total += $cost['monthly_amount'] ?? 0;
            }
        }
        
        return $total;
    }

    public function getFormattedTotalCostAttribute()
    {
        return '€' . number_format($this->total_monthly_cost, 0) . '/mois';
    }

    public function getAmenitiesListAttribute()
    {
        if (!$this->amenities) return '';
        
        return collect($this->amenities)->pluck('name')->implode(', ');
    }

    public function getTransportSummaryAttribute()
    {
        if (!$this->transport_options) return '';
        
        return collect($this->transport_options)->map(function ($transport) {
            return $transport['type'] . ' (' . $transport['distance'] . ')';
        })->implode(', ');
    }

    public function getLocationSummaryAttribute()
    {
        $parts = [$this->city];
        if ($this->district) $parts[] = $this->district;
        if ($this->distance_to_city_center_km) {
            $parts[] = number_format($this->distance_to_city_center_km, 1) . 'km du centre';
        }
        
        return implode(' - ', $parts);
    }

    public function getAvailabilityStatusAttribute()
    {
        if (!$this->is_active) return 'Inactif';
        if (!$this->currently_available) return 'Complet';
        if ($this->available_from && $this->available_from->isFuture()) {
            return 'Disponible à partir du ' . $this->available_from->format('d/m/Y');
        }
        return 'Disponible maintenant';
    }

    public function getAvailabilityStatusColorAttribute()
    {
        return match($this->availability_status) {
            'Disponible maintenant' => 'success',
            'Complet' => 'danger',
            'Inactif' => 'secondary',
            default => 'warning',
        };
    }

    // Méthodes utilitaires
    public function isAvailableForDates($startDate, $endDate)
    {
        if (!$this->is_active || !$this->currently_available) {
            return false;
        }

        if ($this->available_from && $this->available_from > $startDate) {
            return false;
        }

        $stayMonths = $startDate->diffInMonths($endDate);
        
        if ($stayMonths < $this->min_stay_months) {
            return false;
        }

        if ($this->max_stay_months && $stayMonths > $this->max_stay_months) {
            return false;
        }

        return true;
    }

    public function calculateTotalCost($months)
    {
        $monthlyCost = $this->total_monthly_cost;
        $totalCost = $monthlyCost * $months;
        
        // Ajouter les frais d'agence et caution
        $totalCost += $this->agency_fees ?? 0;
        $totalCost += $this->deposit_amount ?? 0;
        
        return $totalCost;
    }

    public function hasAmenity($amenityName)
    {
        if (!$this->amenities) return false;
        
        return collect($this->amenities)->contains('name', $amenityName);
    }

    public function getRandomTestimonial()
    {
        if (!$this->testimonials || count($this->testimonials) === 0) {
            return null;
        }
        
        return $this->testimonials[array_rand($this->testimonials)];
    }

    public function incrementBookings()
    {
        $this->increment('total_bookings');
    }

    public function updateRating($newRating)
    {
        // Calcul simple de la moyenne (peut être amélioré avec un système plus sophistiqué)
        if ($this->average_rating) {
            $totalRatings = $this->total_bookings ?: 1;
            $currentTotal = $this->average_rating * $totalRatings;
            $newAverage = ($currentTotal + $newRating) / ($totalRatings + 1);
            $this->update(['average_rating' => round($newAverage, 2)]);
        } else {
            $this->update(['average_rating' => $newRating]);
        }
    }

    // Méthodes statiques pour filtrage
    public static function getAvailableCities()
    {
        return self::active()->available()
                   ->select('city', 'country')
                   ->distinct()
                   ->orderBy('city')
                   ->get()
                   ->map(function ($housing) {
                       return $housing->city . ', ' . $housing->country;
                   });
    }

    public static function getPriceRange()
    {
        return [
            'min' => self::active()->available()->min('starting_price_monthly'),
            'max' => self::active()->available()->max('starting_price_monthly'),
        ];
    }

    public static function getPopularAmenities()
    {
        $allAmenities = self::active()->available()->pluck('amenities')->flatten(1);
        
        return collect($allAmenities)
            ->groupBy('name')
            ->map(function ($group) {
                return [
                    'name' => $group->first()['name'],
                    'icon' => $group->first()['icon'],
                    'count' => $group->count(),
                ];
            })
            ->sortByDesc('count')
            ->take(10)
            ->values();
    }

    // Méthodes de recherche
    public static function search($criteria)
    {
        $query = self::active()->available();

        if (isset($criteria['city'])) {
            $query->where('city', 'like', '%' . $criteria['city'] . '%');
        }

        if (isset($criteria['housing_type'])) {
            $query->where('housing_type', $criteria['housing_type']);
        }

        if (isset($criteria['min_price'])) {
            $query->where('starting_price_monthly', '>=', $criteria['min_price']);
        }

        if (isset($criteria['max_price'])) {
            $query->where('starting_price_monthly', '<=', $criteria['max_price']);
        }

        if (isset($criteria['furnished'])) {
            $query->where('furnished', $criteria['furnished']);
        }

        if (isset($criteria['couples'])) {
            $query->where('suitable_for_couples', $criteria['couples']);
        }

        if (isset($criteria['min_stay'])) {
            $query->where('min_stay_months', '<=', $criteria['min_stay']);
        }

        if (isset($criteria['max_stay'])) {
            $query->where(function ($q) use ($criteria) {
                $q->whereNull('max_stay_months')
                  ->orWhere('max_stay_months', '>=', $criteria['max_stay']);
            });
        }

        return $query->ordered();
    }

    // Override du toString pour l'affichage
    public function __toString()
    {
        return $this->housing_name . ' (' . $this->city . ')';
    }
}