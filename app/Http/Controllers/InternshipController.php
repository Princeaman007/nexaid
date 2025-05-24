<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InternshipController extends Controller
{
    public function index(Request $request)
    {
        // Création de la requête de base
        $query = Internship::where('is_active', true);
        
        // Récupération des catégories pour le filtre
        $categories = Category::all();
        
        // Application des filtres
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        if ($request->has('location') && $request->location != '') {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        
        if ($request->has('position_type') && $request->position_type != '') {
            $query->where('position_type', $request->position_type);
        }
        
        if ($request->has('remote_option') && $request->remote_option != '') {
            $query->where('remote_option', $request->remote_option);
        }
        
        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                // Recherche dans les champs JSON
                $q->whereRaw('JSON_EXTRACT(title, "$.en") LIKE ?', ['%' . $keyword . '%'])
                  ->orWhereRaw('JSON_EXTRACT(description, "$.en") LIKE ?', ['%' . $keyword . '%'])
                  ->orWhere('company_name', 'like', '%' . $keyword . '%')
                  ->orWhere('location', 'like', '%' . $keyword . '%');
            });
        }
        
        // Récupération des stages avec pagination
        $internships = $query->latest()->paginate(9);
        
        // Options pour les filtres déroulants
        $positionTypes = ['Full-time', 'Part-time', 'Flexible'];
        $remoteOptions = ['On-site', 'Remote', 'Hybrid'];
        
        return view('internships.index', compact(
            'internships', 
            'categories', 
            'positionTypes', 
            'remoteOptions'
        ));
    }

    public function show($slug)
    {
        // Récupération du stage avec ses relations
        $internship = Internship::where('slug', $slug)->firstOrFail();
        
        // Récupération des stages similaires
        $relatedInternships = $internship->relatedInternships();
        
        // Vérification si le stage est expiré
        $isExpired = $internship->isExpired();
        
        return view('internships.show', compact('internship', 'relatedInternships', 'isExpired'));
    }

    public function apply(Internship $internship)
    {
        // Vérification si le stage est expiré
        if ($internship->isExpired()) {
            return redirect()->route('internships.show', $internship->slug)
                ->with('error', 'This internship application deadline has passed.');
        }
        
        return view('internships.apply', compact('internship'));
    }

    public function submitApplication(Request $request, Internship $internship)
    {
        // Vérification si le stage est expiré
        if ($internship->isExpired()) {
            return redirect()->route('internships.show', $internship->slug)
                ->with('error', 'This internship application deadline has passed.');
        }
        
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            'cover_letter' => 'required|string|min:100',
            'education' => 'nullable|string',
            'experience' => 'nullable|string',
            'linkedin' => 'nullable|url',
            'agree_terms' => 'required|accepted',
        ]);

        // Stockage du CV
        $cvPath = $request->file('cv')->store('applications/cvs', 'public');
        
        // Création de la candidature
        $application = $internship->applications()->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cv_path' => $cvPath,
            'cover_letter' => $request->cover_letter,
            'education' => $request->education,
            'experience' => $request->experience,
            'linkedin' => $request->linkedin,
            'status' => 'pending',
            'applied_at' => now(),
        ]);
        
        // Envoi d'emails (à implémenter)
        // Mail::to($request->email)->send(new ApplicationConfirmation($application));
        // Mail::to(config('mail.admin_address'))->send(new NewApplicationNotification($application));
        
        // Redirection avec message de succès
        return redirect()->route('internships.apply.success')
            ->with([
                'success' => true,
                'internship' => $internship->title['en'] ?? ''
            ]);
    }

    public function applicationSuccess()
    {
        // Si l'utilisateur n'arrive pas depuis une soumission de formulaire, redirection
        if (!session('success')) {
            return redirect()->route('internships.index');
        }
        
        return view('internships.apply-success');
    }

    public function featured()
    {
        // Récupération des stages mis en avant
        $featuredInternships = Internship::where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();
            
        return view('internships.featured', compact('featuredInternships'));
    }
}