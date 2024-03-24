<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if (config('locale.status') && Session::has('locale')) {
                if (Session::has('locale') && array_key_exists(Session::get('locale'), config('locale.languages'))) {
                    App::setLocale(Session::get('locale'));
                } else {
                    $userLanguages = preg_split('/[,;]/', $request->server('HTTP_ACCEPT_LANGUAGE'));

                    // Check if $userLanguages is an array and not empty
                    if (is_array($userLanguages) && !empty($userLanguages)) {
                        foreach ($userLanguages as $language) {
                            if (array_key_exists($language, config('locale.languages'))) {
                                App::setLocale($language);
                                setlocale(LC_TIME, config('locale.languages')[$language][2]);
                                Carbon::setLocale(config('locale.languages')[$language][0]);

                                // Use ternary operator to set session based on language direction
                                $rtl = config('locale.languages')[$language][2] ?? false;
                                session(['lang_rtl' => $rtl]);

                                break;
                            }
                        }
                    } else {
                        // Log a warning if $userLanguages is not an array or empty
                        Log::warning('No languages found in HTTP_ACCEPT_LANGUAGE header');
                    }
                }
            }
        } catch (\Exception $e) {
            // Log any exceptions that occur during language detection
            Log::error('Error setting application locale: ' . $e->getMessage());
        }

        return $next($request);
    }
}
