<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\Category;
use Illuminate\Http\Request;

class InternshipController extends Controller
{
    public function index(Request $request)
    {
        // Base query : seuls les stages actifs
        $query = Internship::where('is_active', true);
        
        // Récupération des catégories pour filtre
        $categories = Category::all();
        
        // Application des filtres si présents
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        
        if ($request->filled('position_type')) {
            $query->where('position_type', $request->position_type);
        }
        
        if ($request->filled('remote_option')) {
            $query->where('remote_option', $request->remote_option);
        }
        
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->whereRaw('JSON_EXTRACT(title, "$.en") LIKE ?', ['%' . $keyword . '%'])
                  ->orWhereRaw('JSON_EXTRACT(description, "$.en") LIKE ?', ['%' . $keyword . '%'])
                  ->orWhere('company_name', 'like', '%' . $keyword . '%')
                  ->orWhere('location', 'like', '%' . $keyword . '%');
            });
        }
        
        // Pagination
        $internships = $query->latest()->paginate(9);
        
        // Options statiques pour les filtres déroulants
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
        $internship = Internship::where('slug', $slug)->firstOrFail();
        $relatedInternships = $internship->relatedInternships();
        $isExpired = $internship->isExpired();
        
        return view('internships.show', compact('internship', 'relatedInternships', 'isExpired'));
    }

    public function apply(Internship $internship)
    {
        if ($internship->isExpired()) {
            return redirect()->route('internships.show', $internship->slug)
                ->with('error', 'This internship application deadline has passed.');
        }
        
        return view('internships.apply', compact('internship'));
    }

    public function submitApplication(Request $request, Internship $internship)
    {
        if ($internship->isExpired()) {
            return redirect()->route('internships.show', $internship->slug)
                ->with('error', 'This internship application deadline has passed.');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'cover_letter' => 'required|string|min:100',
            'education' => 'nullable|string',
            'experience' => 'nullable|string',
            'linkedin' => 'nullable|url',
            'agree_terms' => 'required|accepted',
        ]);

        $cvPath = $request->file('cv')->store('applications/cvs', 'public');
        
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
        
        // Envoi mail (à ajouter)
        
        return redirect()->route('internships.apply.success')
            ->with([
                'success' => true,
                'internship' => $internship->title['en'] ?? ''
            ]);
    }

    public function applicationSuccess()
    {
        if (!session('success')) {
            return redirect()->route('internships.index');
        }
        
        return view('internships.apply-success');
    }

    public function featured()
    {
        $featuredInternships = Internship::where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();
            
        return view('internships.featured', compact('featuredInternships'));
    }
}
