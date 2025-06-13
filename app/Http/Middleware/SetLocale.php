<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class SetLocale
{
    public function handle($request, Closure $next)
{
    $availableLocales = config('app.available_locales', ['fr', 'en']);
    $sessionLocale = Session::get('locale');

    if ($sessionLocale && in_array($sessionLocale, $availableLocales)) {
        App::setLocale($sessionLocale);
        logger('✅ Locale appliquée depuis session : ' . $sessionLocale);
    } else {
        App::setLocale(config('app.locale', 'fr'));
        logger('❌ Locale non trouvée en session, fallback : ' . config('app.locale', 'fr'));
        logger('🍪 Cookie Laravel : ' . json_encode($_COOKIE));

    }

    return $next($request);
}

}