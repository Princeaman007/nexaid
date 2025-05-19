<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;

class InternshipController extends Controller
{
    public function index()
    {
        $internships = Internship::where('is_active', true)->get();
        foreach ($internships as $internship) {
            logger('Stage trouvé : ' . json_encode($internship->title));
        }
        return view('internships.index', compact('internships'));
    }

    public function show($slug)
    {
        $internship = Internship::where('slug', $slug)->firstOrFail();
        return view('internships.show', compact('internship'));
    }

    public function apply(Internship $internship)
    {
        return view('internships.apply', compact('internship'));
    }

    public function submitApplication(Request $request, Internship $internship)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'cv' => 'required|file|mimes:pdf,doc,docx',
            'message' => 'nullable|string',
        ]);

        // Exemple : enregistrer la candidature ou envoyer un email
        // Storage::putFile('cvs', $request->file('cv'));

        return back()->with('success', 'Votre candidature a été envoyée avec succès !');
    }
}
