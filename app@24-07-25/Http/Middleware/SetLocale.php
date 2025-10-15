<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
{
    $user = Auth::user();
    $locale = null;
    if (Cookie::has('language')) {
        $locale = Cookie::get('language');
    } elseif ($user && $user->language) {
        $locale = $user->language;
    } elseif ($request->session()->has('locale')) {
        $locale = $request->session()->get('locale');
    }

    if ($locale) {
        app()->setLocale($locale);
    }

    return $next($request);
}
}
