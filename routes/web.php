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

    // Liste des stages
    Route::get('/internships', [InternshipController::class, 'index'])->name('internships.index');
    Route::get('/internships/{slug}', [InternshipController::class, 'show'])->name('internships.show');

    // Candidature
    Route::get('/apply/{internship}', [InternshipController::class, 'apply'])->name('internships.apply');
    Route::post('/apply/{internship}', [InternshipController::class, 'submitApplication'])->name('internships.apply.submit');
    Route::get('/apply-success', [InternshipController::class, 'applicationSuccess'])->name('internships.apply.success');

    // Blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

    // FAQ / Info
    Route::get('/info', [FaqController::class, 'index'])->name('info');

    // Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

    // Partenaires
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');

    // Valeurs & Missions
    Route::get('/values', [ValueMissionController::class, 'index'])->name('values.index');

    // SECTION SERVICES
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/internship-search', [HomeController::class, 'internshipSearch'])->name('internship-search');
        Route::get('/housing', [HomeController::class, 'housing'])->name('housing');
        Route::get('/language-courses', [HomeController::class, 'languageCourses'])->name('language-courses');
        Route::get('/airport-pickup', [HomeController::class, 'airportPickup'])->name('airport-pickup');
        Route::get('/support', [HomeController::class, 'support'])->name('support');
    });

    // SECTION ENTREPRISE
    Route::prefix('company')->name('company.')->group(function () {
        Route::get('/why-intern', [CompanyController::class, 'whyIntern'])->name('why-intern');
        Route::get('/how-it-works', [CompanyController::class, 'howItWorks'])->name('how-it-works');
        Route::get('/send-offer', [CompanyController::class, 'sendOffer'])->name('send-offer');
        Route::post('/send-offer', [CompanyController::class, 'storeOffer'])->name('store-offer');
    });

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
// ROUTES API (optionnelles)
// -----------------------------
Route::prefix('api')->name('api.')->group(function () {
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
