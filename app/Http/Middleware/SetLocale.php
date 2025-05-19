<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
            logger('Langue active : ' . App::getLocale());
        } else {
            logger('Aucune langue en session.');
        }

        // ⚡ Ajoute l'ID de session dans le log pour qu'on vérifie si elle change
        logger('Session ID : ' . Session::getId());

        return $next($request);
    }
}
