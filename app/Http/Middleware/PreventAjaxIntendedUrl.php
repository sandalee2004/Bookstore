<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventAjaxIntendedUrl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // List of paths that should never be stored as intended URLs
        $excludedPaths = [
            '/cart/items',
            '/cart/count', 
            '/cart/add',
            // Add other AJAX endpoints here
        ];

        // Check if this is an AJAX request or if the path should be excluded
        if ($request->ajax() || 
            $request->wantsJson() || 
            $request->expectsJson() ||
            str_contains($request->header('Accept', ''), 'application/json')) {
            
            // Don't store AJAX requests as intended URLs
            return $next($request);
        }

        // Check if current path should be excluded
        foreach ($excludedPaths as $excludedPath) {
            if (str_contains($request->getPathInfo(), $excludedPath)) {
                return $next($request);
            }
        }

        return $next($request);
    }
}