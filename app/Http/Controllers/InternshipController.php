<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\Application;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class InternshipController extends Controller
{
    /**
     * Afficher la liste des stages avec filtres
     */
    public function index(Request $request)
    {
        // Base query : seuls les stages actifs
        $query = Internship::with('category')->where('is_active', true);
        
        // Récupération des catégories pour filtre
        $categories = Category::all();
        
        // Application des filtres
        $this->applyFilters($query, $request);
        
        // Tri
        $this->applySorting($query, $request);
        
        // Pagination avec conservation des paramètres
        $internships = $query->paginate(12)->withQueryString();
        
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

    /**
     * Afficher un stage spécifique
     */
    public function show($slug)
    {
        $internship = Internship::with('category')
                                ->where('slug', $slug)
                                ->where('is_active', true)
                                ->firstOrFail();
        
        $relatedInternships = $internship->relatedInternships(3);
        $isExpired = $internship->isExpired();
        
        return view('internships.show', compact('internship', 'relatedInternships', 'isExpired'));
    }

    /**
     * Afficher le formulaire de candidature
     */
    public function apply(Internship $internship)
    {
        // Vérifications de disponibilité
        if (!$internship->is_active) {
            return redirect()->route('internships.index')
                           ->with('error', __('This internship is no longer available.'));
        }

        if ($internship->isExpired()) {
            return redirect()->route('internships.show', $internship->slug)
                           ->with('error', __('This internship application deadline has passed.'));
        }
        
        return view('internships.apply', compact('internship'));
    }

    /**
     * Traiter la soumission de candidature
     */
    public function submitApplication(Request $request, Internship $internship)
    {
        // Vérifications préliminaires
        if (!$internship->is_active || $internship->isExpired()) {
            return redirect()->route('internships.show', $internship->slug)
                           ->with('error', __('This internship is no longer available for applications.'));
        }

        // Vérifier si l'utilisateur a déjà postulé
        $existingApplication = Application::where('internship_id', $internship->id)
                                         ->where('email', $request->email)
                                         ->first();

        if ($existingApplication) {
            return back()->withErrors([
                'email' => __('You have already applied for this internship.')
            ])->withInput();
        }

        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'linkedin' => 'nullable|url|max:255',
            'education' => 'nullable|string|max:2000',
            'experience' => 'nullable|string|max:2000',
            'cover_letter' => 'required|string|min:100|max:5000',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            'agree_terms' => 'required|accepted',
        ], [
            'name.required' => __('The name field is required.'),
            'email.required' => __('The email field is required.'),
            'email.email' => __('Please enter a valid email address.'),
            'cover_letter.required' => __('The cover letter is required.'),
            'cover_letter.min' => __('The cover letter must be at least 100 characters.'),
            'cv.required' => __('Please upload your CV.'),
            'cv.file' => __('The CV must be a file.'),
            'cv.mimes' => __('The CV must be a PDF, DOC, or DOCX file.'),
            'cv.max' => __('The CV may not be larger than 5MB.'),
            'agree_terms.required' => __('You must agree to the terms and conditions.'),
        ]);

        try {
            // Traitement du fichier CV
            $cvPath = $this->handleCvUpload($request->file('cv'), $validatedData['name']);

            // Créer la candidature
            $application = Application::create([
                'internship_id' => $internship->id,
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'linkedin' => $validatedData['linkedin'],
                'education' => $validatedData['education'],
                'experience' => $validatedData['experience'],
                'cover_letter' => $validatedData['cover_letter'],
                'cv_path' => $cvPath,
                'status' => 'pending',
                'applied_at' => now(),
            ]);

            // Envoyer les emails de notification
            $this->sendNotificationEmails($application, $internship);

            // Log de la candidature
            Log::info('New application submitted', [
                'application_id' => $application->id,
                'internship_id' => $internship->id,
                'applicant_email' => $application->email,
            ]);

            // Rediriger vers la page de succès
            return redirect()->route('internships.apply.success')
                           ->with([
                               'success' => true,
                               'internship' => $internship->getTranslation('title', app()->getLocale()),
                               'email' => $validatedData['email']
                           ]);

        } catch (\Exception $e) {
            // En cas d'erreur, nettoyer les fichiers uploadés
            if (isset($cvPath) && Storage::disk('public')->exists($cvPath)) {
                Storage::disk('public')->delete($cvPath);
            }

            Log::error('Application submission failed', [
                'internship_id' => $internship->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withErrors([
                'error' => __('An error occurred while submitting your application. Please try again.')
            ])->withInput();
        }
    }

    /**
     * Afficher la page de succès
     */
    public function applicationSuccess()
    {
        if (!session('success') || !session('internship')) {
            return redirect()->route('internships.index');
        }
        
        return view('internships.application-success');
    }

    /**
     * Afficher les stages en vedette
     */
    public function featured()
    {
        $featuredInternships = Internship::with('category')
                                        ->where('is_active', true)
                                        ->where('is_featured', true)
                                        ->latest()
                                        ->take(6)
                                        ->get();
            
        return view('internships.featured', compact('featuredInternships'));
    }

    /**
     * Appliquer les filtres de recherche
     */
    private function applyFilters($query, Request $request)
    {
        // Filtre par catégorie
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Filtre par localisation
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        
        // Filtre par type de poste
        if ($request->filled('position_type')) {
            $query->where('position_type', $request->position_type);
        }
        
        // Filtre par option télétravail
        if ($request->filled('remote_option')) {
            $query->where('remote_option', $request->remote_option);
        }

        // Filtre par durée
        if ($request->filled('duration')) {
            $duration = $request->duration;
            switch ($duration) {
                case '1-3':
                    $query->where('duration', 'like', '%1%')
                          ->orWhere('duration', 'like', '%2%')
                          ->orWhere('duration', 'like', '%3%');
                    break;
                case '3-6':
                    $query->where('duration', 'like', '%3%')
                          ->orWhere('duration', 'like', '%4%')
                          ->orWhere('duration', 'like', '%5%')
                          ->orWhere('duration', 'like', '%6%');
                    break;
                case '6+':
                    $query->where('duration', 'like', '%6%')
                          ->orWhere('duration', 'like', '%7%')
                          ->orWhere('duration', 'like', '%8%')
                          ->orWhere('duration', 'like', '%9%')
                          ->orWhere('duration', 'like', '%10%')
                          ->orWhere('duration', 'like', '%11%')
                          ->orWhere('duration', 'like', '%12%');
                    break;
            }
        }

        // Filtre par date de début
        if ($request->filled('start_date')) {
            $query->whereDate('start_date', '>=', $request->start_date);
        }
        
        // Recherche par mot-clé
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $locale = app()->getLocale();
            
            $query->where(function($q) use ($keyword, $locale) {
                // Recherche dans les titres traduits
                $q->whereRaw("JSON_EXTRACT(title, '$.{$locale}') LIKE ?", ['%' . $keyword . '%'])
                  ->orWhereRaw("JSON_EXTRACT(title, '$.en') LIKE ?", ['%' . $keyword . '%'])
                  ->orWhereRaw("JSON_EXTRACT(title, '$.fr') LIKE ?", ['%' . $keyword . '%'])
                  // Recherche dans les descriptions traduites
                  ->orWhereRaw("JSON_EXTRACT(description, '$.{$locale}') LIKE ?", ['%' . $keyword . '%'])
                  ->orWhereRaw("JSON_EXTRACT(description, '$.en') LIKE ?", ['%' . $keyword . '%'])
                  ->orWhereRaw("JSON_EXTRACT(description, '$.fr') LIKE ?", ['%' . $keyword . '%'])
                  // Recherche dans les autres champs
                  ->orWhere('company_name', 'like', '%' . $keyword . '%')
                  ->orWhere('location', 'like', '%' . $keyword . '%');
            });
        }
    }

    /**
     * Appliquer le tri
     */
    private function applySorting($query, Request $request)
    {
        $sort = $request->get('sort');
        
        switch ($sort) {
            case 'date_desc':
                $query->latest();
                break;
            case 'date_asc':
                $query->oldest();
                break;
            case 'duration_asc':
                $query->orderBy('duration');
                break;
            case 'title_asc':
                $query->orderByRaw("JSON_EXTRACT(title, '$.fr')");
                break;
            default:
                $query->latest('created_at');
                break;
        }
    }

    /**
     * Gérer l'upload du CV
     */
    private function handleCvUpload($file, $applicantName)
    {
        $timestamp = time();
        $sanitizedName = Str::slug($applicantName);
        $extension = $file->getClientOriginalExtension();
        $fileName = "{$timestamp}_{$sanitizedName}.{$extension}";
        
        return $file->storeAs('applications/cvs', $fileName, 'public');
    }

    /**
     * Envoyer les emails de notification
     */
    private function sendNotificationEmails(Application $application, Internship $internship)
    {
        try {
            // Email de confirmation au candidat
            // Décommentez ces lignes quand vous aurez créé les classes Mail
            // Mail::to($application->email)->send(new \App\Mail\ApplicationConfirmation($application, $internship));

            // Email de notification à l'entreprise/RH
            // if ($internship->contact_email) {
            //     Mail::to($internship->contact_email)->send(new \App\Mail\NewApplicationNotification($application, $internship));
            // }

            // Email de notification interne
            // Mail::to(config('mail.admin_email', 'admin@example.com'))
            //     ->send(new \App\Mail\InternalApplicationNotification($application, $internship));

        } catch (\Exception $e) {
            // Log l'erreur sans faire échouer la candidature
            Log::warning('Failed to send application emails', [
                'application_id' => $application->id,
                'error' => $e->getMessage()
            ]);
        }
    }
}