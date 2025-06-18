<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\HousingService;
use App\Models\InternshipSearchService;
use App\Models\SupportService;
use App\Models\AirportPickupService;

class ServiceController extends Controller
{
    // Page d'accueil des services
    public function index()
    {
        $services = [
            'internship_search' => Service::getInternshipSearch(),
            'housing' => Service::getHousing(),
            'airport_pickup' => Service::getAirportPickup(),
            'support' => Service::getSupport(),
        ];

        return view('services.index', compact('services'));
    }

    // Service de recherche de stage
    public function internshipSearch()
    {
        $service = Service::getInternshipSearch();
        $packages = InternshipSearchService::active()->ordered()->get();
        
        return view('services.internship-search', compact('service', 'packages'));
    }

    // Service de logement
    public function housing()
    {
        $service = Service::getHousing();
        $housings = HousingService::active()->available()->ordered()->paginate(12);
        
        // Filtres pour la recherche
        $cities = HousingService::getAvailableCities();
        $priceRange = HousingService::getPriceRange();
        $types = HousingService::TYPES;
        
        return view('services.housing', compact('service', 'housings', 'cities', 'priceRange', 'types'));
    }

    // Détail d'un logement
    public function housingDetail($id)
    {
        $housing = HousingService::active()->available()->findOrFail($id);
        $service = Service::getHousing();
        
        // Logements similaires
        $similarHousings = HousingService::active()->available()
            ->where('id', '!=', $id)
            ->where('housing_type', $housing->housing_type)
            ->where('city', $housing->city)
            ->limit(3)
            ->get();
        
        return view('services.housing-detail', compact('housing', 'service', 'similarHousings'));
    }

    // Service de transport aéroport
    public function airportPickup()
    {
        $service = Service::getAirportPickup();
        $pickupServices = AirportPickupService::active()->acceptingBookings()->ordered()->get();
        
        return view('services.airport-pickup', compact('service', 'pickupServices'));
    }

    // Service de support
    public function support()
    {
        $service = Service::getSupport();
        $supportServices = SupportService::active()->acceptingClients()->ordered()->get();
        
        // Grouper par type
        $supportByType = $supportServices->groupBy('support_type');
        
        return view('services.support', compact('service', 'supportServices', 'supportByType'));
    }

    // Détail d'un service de support
    public function supportDetail($id)
    {
        $supportService = SupportService::active()->acceptingClients()->findOrFail($id);
        $service = Service::getSupport();
        
        return view('services.support-detail', compact('supportService', 'service'));
    }

    // Recherche de logements avec filtres
    public function searchHousing(Request $request)
    {
        $query = HousingService::active()->available();
        
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }
        
        if ($request->filled('type')) {
            $query->where('housing_type', $request->type);
        }
        
        if ($request->filled('min_price')) {
            $query->where('starting_price_monthly', '>=', $request->min_price);
        }
        
        if ($request->filled('max_price')) {
            $query->where('starting_price_monthly', '<=', $request->max_price);
        }
        
        if ($request->filled('furnished')) {
            $query->where('furnished', $request->furnished == '1');
        }
        
        if ($request->filled('couples')) {
            $query->where('suitable_for_couples', $request->couples == '1');
        }
        
        $housings = $query->ordered()->paginate(12)->withQueryString();
        $service = Service::getHousing();
        
        // Données pour les filtres
        $cities = HousingService::getAvailableCities();
        $priceRange = HousingService::getPriceRange();
        $types = HousingService::TYPES;
        
        return view('services.housing', compact('service', 'housings', 'cities', 'priceRange', 'types'));
    }

    // API pour obtenir les données d'un service (AJAX)
    public function getServiceData($type, $id = null)
    {
        $serviceData = Service::getSpecificService($type, $id);
        
        if (!$serviceData) {
            return response()->json(['error' => 'Service not found'], 404);
        }
        
        return response()->json($serviceData);
    }

    // Statistiques d'un service
    public function getServiceStats($type)
    {
        $service = Service::where('type', $type)->active()->first();
        
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }
        
        $stats = $service->getServiceStats();
        
        return response()->json($stats);
    }
}