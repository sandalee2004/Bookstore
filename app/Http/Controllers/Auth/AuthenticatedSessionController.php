<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Get the intended URL from session
        $intendedUrl = $request->session()->get('url.intended');
        
        // List of URLs that should NOT be used as redirect destinations
        $excludedPaths = [
            '/cart/items',
            '/cart/count',
            '/cart/add',
            'cart/items',
            'cart/count', 
            'cart/add',
            // Add any other AJAX endpoints that shouldn't be redirect destinations
        ];

        // Check if intended URL contains any excluded paths
        $shouldExcludeIntended = false;
        if ($intendedUrl) {
            foreach ($excludedPaths as $excludedPath) {
                if (str_contains($intendedUrl, $excludedPath)) {
                    $shouldExcludeIntended = true;
                    break;
                }
            }
        }

        // If intended URL is excluded or empty, redirect to dashboard
        if ($shouldExcludeIntended || !$intendedUrl) {
            // Clear the intended URL from session to prevent future issues
            $request->session()->forget('url.intended');
            return redirect()->route('dashboard');
        }

        // Use the intended URL if it's safe
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}