<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\Internship;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ValueMissionController;
use App\Http\Controllers\CompanyController;

// -----------------------------
// CHANGER DE LANGUE
// -----------------------------
Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['fr', 'en'])) {
        abort(400);
    }

    // Stockez la locale dans la session
    session(['locale' => $locale]);
    
    // Assurez-vous que la session est sauvegardée immédiatement
    session()->save();
    
    // Définis explicitement la locale pour la requête en cours
    App::setLocale($locale);
    
    // Enregistrement dans les logs pour le débogage
    logger('Langue changée en : ' . $locale);
    logger('Session ID après changement : ' . session()->getId());

    // Ajoute un message flash pour confirmer le changement
    return redirect()->back()->with('locale_set', $locale);
})->name('language.switch');  // Ajouté le nom de la route ici

// -----------------------------
// ROUTES PUBLIQUES
// -----------------------------

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

// Section Services
Route::prefix('services')->group(function () {
    Route::get('/internship-search', [HomeController::class, 'internshipSearch'])->name('services.internship-search');
    Route::get('/housing', [HomeController::class, 'housing'])->name('services.housing');
    Route::get('/language-courses', [HomeController::class, 'languageCourses'])->name('services.language-courses');
    Route::get('/airport-pickup', [HomeController::class, 'airportPickup'])->name('services.airport-pickup');
    Route::get('/support', [HomeController::class, 'support'])->name('services.support');
});

// Section Entreprise
Route::prefix('company')->group(function () {
    Route::get('/why-intern', [CompanyController::class, 'whyIntern'])->name('company.why-intern');
    Route::get('/how-it-works', [CompanyController::class, 'howItWorks'])->name('company.how-it-works');
    Route::get('/send-offer', [CompanyController::class, 'sendOffer'])->name('company.send-offer');
    Route::post('/send-offer', [CompanyController::class, 'storeOffer'])->name('company.store-offer');
});