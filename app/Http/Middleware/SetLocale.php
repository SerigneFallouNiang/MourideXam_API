<?php
// app/Http/Middleware/SetLocale.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // Récupérer la langue de l'utilisateur authentifié
        if ($request->user() && $request->user()->language) {
            $locale = $request->user()->language;
        } else {
            // $locale = config('app.locale');
            $locale = 'fr';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
