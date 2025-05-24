<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Vérifier si une locale est définie en session
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            
            // Vérifier que la locale est valide (fr ou en)
            if (in_array($locale, ['fr', 'en'])) {
                // Définir explicitement la locale de l'application
                App::setLocale($locale);
            }
        }
        
        // Log pour débogage
        logger('Langue active dans middleware: ' . App::getLocale());
        
        return $next($request);
    }
}