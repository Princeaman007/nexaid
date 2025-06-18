<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Afficher la page FAQ avec toutes les questions actives
     */
    public function index()
    {
        // Récupérer uniquement les FAQ actives, triées par ordre de création
        $faqs = Faq::where('is_active', true)
                   ->orderBy('created_at', 'asc')
                   ->get();
        
        return view('faq.index', compact('faqs'));
    }
    
    /**
     * API pour la recherche de FAQ (optionnel)
     */
    public function search(Request $request)
    {
        $searchTerm = $request->get('q');
        
        if (!$searchTerm) {
            return response()->json([]);
        }
        
        $faqs = Faq::where('is_active', true)
                   ->where(function($query) use ($searchTerm) {
                       $query->whereRaw("JSON_EXTRACT(question, '$.fr') LIKE ?", ["%{$searchTerm}%"])
                             ->orWhereRaw("JSON_EXTRACT(question, '$.en') LIKE ?", ["%{$searchTerm}%"])
                             ->orWhereRaw("JSON_EXTRACT(answer, '$.fr') LIKE ?", ["%{$searchTerm}%"])
                             ->orWhereRaw("JSON_EXTRACT(answer, '$.en') LIKE ?", ["%{$searchTerm}%"]);
                   })
                   ->get()
                   ->map(function($faq) {
                       return [
                           'id' => $faq->id,
                           'question' => $faq->getTranslation('question', app()->getLocale()),
                           'answer' => $faq->getTranslation('answer', app()->getLocale())
                       ];
                   });
        
        return response()->json($faqs);
    }
    
    /**
     * Enregistrer le feedback d'une FAQ (optionnel)
     */
    public function feedback(Request $request, Faq $faq)
    {
        $request->validate([
            'helpful' => 'required|in:yes,no'
        ]);
        
        // Ici vous pouvez sauvegarder le feedback dans une table séparée
        // ou ajouter des colonnes helpful_count, not_helpful_count à votre modèle FAQ
        
        return response()->json([
            'success' => true,
            'message' => 'Merci pour votre feedback!'
        ]);
    }
}