<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\SetLocale;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ValueMissionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PartnershipRequestController;

// -----------------------------
// ROUTES AVEC MIDDLEWARE 'web'
// -----------------------------
Route::middleware(['web'])->group(function () {

    // Route changement de langue
    Route::get('/lang/{locale}', function ($locale) {
        $availableLocales = config('app.available_locales', ['fr', 'en']);

        if (!in_array($locale, $availableLocales)) {
            abort(400, 'Langue non supportée');
        }

        session(['locale' => $locale]);
        session()->save(); // ✅ Force l'écriture immédiate

        logger('✅ Langue changée en : ' . $locale);
        logger('📦 Contenu session après écriture :', session()->all());

        return redirect('/')->with('locale_set', $locale); // ✅ redirection fixe
    })->name('language.switch');

    // Route de test pour debug
    Route::get('/test-locale', function () {
        return response()->json([
            'locale' => app()->getLocale(),
            'session_locale' => session('locale'),
            'label' => __('nav.home'),
        ]);
    })->middleware(SetLocale::class);

    // Page d'accueil
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Routes pour les stages
    Route::prefix('internships')->name('internships.')->group(function () {
        Route::get('/', [InternshipController::class, 'index'])->name('index');
        Route::get('/{internship:slug}', [InternshipController::class, 'show'])->name('show');
    });

    // Routes pour les candidatures
    Route::prefix('apply')->group(function () {
        Route::get('/{internship}', [InternshipController::class, 'apply'])->name('internships.apply');
        Route::post('/{internship}', [InternshipController::class, 'submitApplication'])->name('internships.apply.submit');
        Route::get('/success/confirmation', [InternshipController::class, 'applicationSuccess'])->name('internships.apply.success');
    });

    // Blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

    // FAQ / Info
    Route::get('/info', [FaqController::class, 'index'])->name('info');

    // Routes pour le contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

    // Partenaires
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');

    // Valeurs & Missions
    Route::get('/values', [ValueMissionController::class, 'index'])->name('values.index');

    // Services
    Route::prefix('services')->name('services.')->group(function () {
        // Page d'accueil des services
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        
        // Service de recherche de stage
        Route::get('/internship-search', [ServiceController::class, 'internshipSearch'])->name('internship-search');
        
        // Service de logement
        Route::get('/housing', [ServiceController::class, 'housing'])->name('housing');
        Route::get('/housing/search', [ServiceController::class, 'searchHousing'])->name('housing.search');
        Route::get('/housing/{id}', [ServiceController::class, 'housingDetail'])->name('housing.detail');
        
        // Service de transport aéroport
        Route::get('/airport-pickup', [ServiceController::class, 'airportPickup'])->name('airport-pickup');
        
        // Service de support
        Route::get('/support', [ServiceController::class, 'support'])->name('support');
        Route::get('/support/{id}', [ServiceController::class, 'supportDetail'])->name('support.detail');
    });

    // FAQ
    Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
    Route::get('/faq/search', [FaqController::class, 'search'])->name('faq.search');
    Route::post('/faq/{faq}/feedback', [FaqController::class, 'feedback'])->name('faq.feedback');

    // Test session
    Route::get('/session-test', function () {
        $previous = session('test_value', 'none');
        session(['test_value' => 'hello']);
        return response()->json([
            'session_id' => session()->getId(),
            'previous_test_value' => $previous,
        ]);
    });
});

// -----------------------------
// ROUTES ENTREPRISES & PARTENARIATS - VERSION UNIFIÉE
// -----------------------------
Route::prefix('compagnies')->name('compagnies.')->group(function () {
    // Pages d'information par type
    Route::get('/hiring', [CompanyController::class, 'hiring'])->name('hiring');
    Route::get('/partnership', [CompanyController::class, 'partnership'])->name('partnership');
    Route::get('/send-offer', [CompanyController::class, 'offerSender'])->name('send-offer');
    
    // Afficher le formulaire de partenariat (GET)
    Route::get('/register', function () {
        return view('compagnies.register', ['type' => 'partnership']);
    })->name('register');
    
    // Traitement de la soumission du formulaire (POST)
    Route::post('/register', [PartnershipRequestController::class, 'store'])->name('register.submit');
    
    // Page de succès après soumission
    Route::get('/success', function () {
        return view('compagnies.success');
    })->name('success');
    
    // Liste publique des compagnies (si nécessaire)
    Route::get('/', [CompanyController::class, 'index'])->name('index');
});

// // Redirections pour compatibilité avec les anciennes URLs
// Route::get('/companies/partnership', function () {
//     return redirect()->route('compagnies.register');
// });

// Route::get('/compagnies/partnership', function () {
//     return redirect()->route('compagnies.register');
// });

// Route::get('/compagnies/register', function () {
//     return redirect()->route('compagnies.register');
// });

// Routes admin pour la gestion des demandes (avec middleware auth)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Mettre à jour le statut d'une demande
    Route::patch('/partnership-requests/{partnershipRequest}/status', 
                [PartnershipRequestController::class, 'updateStatus'])
         ->name('partnership-requests.update-status');
    
    // Mise à jour en masse des statuts
    Route::post('/partnership-requests/bulk-status', 
                [PartnershipRequestController::class, 'bulkUpdateStatus'])
         ->name('partnership-requests.bulk-status');
});

// -----------------------------
// ROUTES API
// -----------------------------
Route::prefix('api')->name('api.')->group(function () {
    // Traductions
    Route::get('/translations/{locale}', function($locale) {
        $availableLocales = config('app.available_locales', ['fr', 'en']);

        if (!in_array($locale, $availableLocales)) {
            return response()->json(['error' => 'Langue non supportée'], 400);
        }

        return response()->json([
            'locale' => $locale,
            'translations' => trans('messages', [], $locale),
            'available_locales' => $availableLocales,
            'locale_names' => config('app.locale_names', [])
        ]);
    })->name('translations');

    Route::post('/change-language', function(Illuminate\Http\Request $request) {
        $locale = $request->input('locale');
        $availableLocales = config('app.available_locales', ['fr', 'en']);

        if (!in_array($locale, $availableLocales)) {
            return response()->json(['error' => 'Langue non supportée'], 400);
        }

        session(['locale' => $locale]);
        App::setLocale($locale);

        return response()->json([
            'success' => true,
            'locale' => $locale,
            'message' => __('Langue changée avec succès')
        ]);
    })->name('change-language');

    // API Partenariats (avec authentification)
    Route::middleware(['auth:sanctum'])->group(function () {
        // Statistiques des demandes
        Route::get('/partnership-requests/statistics', 
                   [PartnershipRequestController::class, 'statistics'])
             ->name('partnership-requests.statistics');
        
        // CRUD API pour les demandes
        Route::get('/partnership-requests', [PartnershipRequestController::class, 'index'])
             ->name('partnership-requests.index');
        
        Route::get('/partnership-requests/{partnershipRequest}', 
                   [PartnershipRequestController::class, 'show'])
             ->name('partnership-requests.show');
        
        Route::delete('/partnership-requests/{partnershipRequest}', 
                      [PartnershipRequestController::class, 'destroy'])
             ->name('partnership-requests.destroy');
    });
});

// -----------------------------
// SITEMAP
// -----------------------------
Route::get('/sitemap.xml', function() {
    $urls = [];
    $locales = config('app.available_locales', ['fr', 'en']);

    $routes = [
        'home', 'internships.index', 'blog.index', 'partners.index',
        'values.index', 'info', 'contact.index'
    ];

    foreach ($locales as $locale) {
        foreach ($routes as $route) {
            $urls[] = [
                'url' => url(route($route)),
                'lastmod' => now()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ];
        }
    }

    return response()->view('sitemap', compact('urls'))
                     ->header('Content-Type', 'text/xml');
})->name('sitemap');