<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AirportPickupService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'airport_code',
        'airport_name',
        'city',
        'country',
        'base_price_0_20km',
        'base_price_21_40km',
        'base_price_41_60km',
        'price_per_km_beyond_60km',
        'night_surcharge_percentage',
        'weekend_surcharge_percentage',
        'luggage_fee_per_bag',
        'waiting_fee_per_hour',
        'vehicle_types',
        'service_start_time',
        'service_end_time',
        'operates_24_7',
        'advance_booking_hours',
        'max_passengers',
        'is_active',
        'currently_accepting_bookings',
        'service_rating',
        'total_transfers_completed',
        'contact_phone',
        'contact_email',
        'special_instructions',
        'accepted_payment_methods',
        'covered_postcodes',
        'max_distance_km',
    ];

    protected $casts = [
        'vehicle_types' => 'array',
        'accepted_payment_methods' => 'array',
        'covered_postcodes' => 'array',
        'is_active' => 'boolean',
        'currently_accepting_bookings' => 'boolean',
        'operates_24_7' => 'boolean',
        'service_start_time' => 'datetime:H:i',
        'service_end_time' => 'datetime:H:i',
        'base_price_0_20km' => 'decimal:2',
        'base_price_21_40km' => 'decimal:2',
        'base_price_41_60km' => 'decimal:2',
        'price_per_km_beyond_60km' => 'decimal:2',
        'night_surcharge_percentage' => 'decimal:2',
        'weekend_surcharge_percentage' => 'decimal:2',
        'luggage_fee_per_bag' => 'decimal:2',
        'waiting_fee_per_hour' => 'decimal:2',
        'service_rating' => 'decimal:1',
        'max_distance_km' => 'decimal:2',
    ];

    // Scopes requis par le modèle Service
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeAcceptingBookings($query)
    {
        return $query->where('currently_accepting_bookings', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('service_rating', 'desc')
                     ->orderBy('total_transfers_completed', 'desc');
    }

    // Scopes additionnels
    public function scopeByCity($query, $city)
    {
        return $query->where('city', $city);
    }

    public function scopeByAirport($query, $airportCode)
    {
        return $query->where('airport_code', $airportCode);
    }

    public function scopeOperating24h($query)
    {
        return $query->where('operates_24_7', true);
    }

    public function scopeHighRated($query, $minRating = 4.0)
    {
        return $query->where('service_rating', '>=', $minRating);
    }

    // Relation polymorphe avec Service
    public function service()
    {
        return $this->morphOne(Service::class, 'serviceable');
    }

    // Accessors
    public function getFormattedRatingAttribute()
    {
        return number_format($this->service_rating, 1) . '/5';
    }

    public function getVehicleTypesListAttribute()
    {
        $types = [
            'sedan' => 'Berline',
            'suv' => 'SUV',
            'van' => 'Van',
            'luxury' => 'Véhicule de luxe',
            'minibus' => 'Minibus',
        ];

        return collect($this->vehicle_types)->map(function ($type) use ($types) {
            return $types[$type] ?? $type;
        })->implode(', ');
    }

    public function getPaymentMethodsListAttribute()
    {
        $methods = [
            'cash' => 'Espèces',
            'card' => 'Carte bancaire',
            'paypal' => 'PayPal',
            'bank_transfer' => 'Virement bancaire',
            'apple_pay' => 'Apple Pay',
            'google_pay' => 'Google Pay',
        ];

        return collect($this->accepted_payment_methods)->map(function ($method) use ($methods) {
            return $methods[$method] ?? $method;
        })->implode(', ');
    }

    public function getServiceHoursAttribute()
    {
        if ($this->operates_24_7) {
            return '24h/24';
        }

        return $this->service_start_time->format('H:i') . ' - ' . $this->service_end_time->format('H:i');
    }

    // Méthodes utilitaires
    public function calculatePrice($distance, $isNight = false, $isWeekend = false, $luggageBags = 0, $waitingHours = 0)
    {
        // Prix de base selon la distance
        $basePrice = 0;
        if ($distance <= 20) {
            $basePrice = $this->base_price_0_20km;
        } elseif ($distance <= 40) {
            $basePrice = $this->base_price_21_40km;
        } elseif ($distance <= 60) {
            $basePrice = $this->base_price_41_60km;
        } else {
            $basePrice = $this->base_price_41_60km + (($distance - 60) * $this->price_per_km_beyond_60km);
        }

        // Suppléments
        if ($isNight) {
            $basePrice *= (1 + $this->night_surcharge_percentage / 100);
        }

        if ($isWeekend) {
            $basePrice *= (1 + $this->weekend_surcharge_percentage / 100);
        }

        // Frais bagages
        $basePrice += ($luggageBags * $this->luggage_fee_per_bag);

        // Frais d'attente
        $basePrice += ($waitingHours * $this->waiting_fee_per_hour);

        return round($basePrice, 2);
    }

    public function isAvailableForBooking()
    {
        return $this->is_active && $this->currently_accepting_bookings;
    }

    public function canAcceptDistance($distance)
    {
        return $distance <= $this->max_distance_km;
    }

    public function isOperatingNow()
    {
        if ($this->operates_24_7) {
            return true;
        }

        $now = now()->format('H:i');
        $start = $this->service_start_time->format('H:i');
        $end = $this->service_end_time->format('H:i');

        return $now >= $start && $now <= $end;
    }

    public function getBookingLeadTime()
    {
        return $this->advance_booking_hours . ' heures à l\'avance';
    }

    // Méthodes statiques
    public static function getAvailableAirports()
    {
        return self::active()
                   ->acceptingBookings()
                   ->select('airport_code', 'airport_name', 'city')
                   ->distinct()
                   ->orderBy('city')
                   ->get();
    }

    public static function getBestRated($limit = 5)
    {
        return self::active()
                   ->acceptingBookings()
                   ->orderBy('service_rating', 'desc')
                   ->limit($limit)
                   ->get();
    }

    public static function getMostExperienced($limit = 5)
    {
        return self::active()
                   ->acceptingBookings()
                   ->orderBy('total_transfers_completed', 'desc')
                   ->limit($limit)
                   ->get();
    }

    // Override du toString pour l'affichage
    public function __toString()
    {
        return $this->name . ' (' . $this->airport_code . ')';
    }
}