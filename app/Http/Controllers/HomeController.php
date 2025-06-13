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

    // Méthodes pour les services
    public function internshipSearch()
    {
        return view('services.internship-search');
    }

    public function housing()
    {
        return view('services.housing');
    }

    public function languageCourses()
    {
        return view('services.language-courses');
    }

    public function airportPickup()
    {
        return view('services.airport-pickup');
    }

    public function support()
    {
        return view('services.support');
    }
}