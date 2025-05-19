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
// -----------------------------
// CHANGER DE LANGUE
// -----------------------------
Route::get('lang/{locale}', function ($locale) {
    if (!in_array($locale, ['fr', 'en'])) {
        abort(400);
    }

    session(['locale' => $locale]);
    App::setLocale($locale);
    logger('Langue changée en : ' . $locale);

    return back();
});

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
