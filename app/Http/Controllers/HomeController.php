<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\BlogPost;
use App\Models\Partner;

class HomeController extends Controller
{
    public function index()
    {
        $internships = Internship::where('is_active', true)->latest()->take(3)->get();
        $blogs = BlogPost::where('is_active', true)->latest()->take(3)->get();
        $partners = Partner::where('is_active', true)->get();

        return view('home', compact('internships', 'blogs', 'partners'));
    }

    /**
     * Page du service de recherche de stage
     */
    public function internshipSearch()
    {
        // Vous pourriez récupérer des données ici si nécessaire pour cette page
        // Par exemple, quelques témoignages de personnes ayant trouvé un stage
        return view('services.internship-search');
    }

    /**
     * Page du service de logement
     */
    public function housing()
    {
        // Vous pourriez récupérer des données ici si nécessaire pour cette page
        // Par exemple, des types de logements disponibles ou des témoignages
        return view('services.housing');
    }

    /**
     * Page du service de cours de langue
     */
    public function languageCourses()
    {
        // Vous pourriez récupérer des données ici si nécessaire pour cette page
        // Par exemple, les langues disponibles, les niveaux, etc.
        return view('services.language-courses');
    }

    /**
     * Page du service de transport depuis l'aéroport
     */
    public function airportPickup()
    {
        // Vous pourriez récupérer des données ici si nécessaire pour cette page
        // Par exemple, les aéroports desservis, les tarifs, etc.
        return view('services.airport-pickup');
    }

    /**
     * Page du service de support
     */
    public function support()
    {
        // Vous pourriez récupérer des données ici si nécessaire pour cette page
        // Par exemple, les types de support, les témoignages, etc.
        return view('services.support');
    }
}