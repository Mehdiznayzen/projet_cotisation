<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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
    

    // Depenses/ cotisations
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cas spécial pour admin@admin.com sans base de données
        if (
            $request->email === 'admin@admin.com' &&
            $request->password === 'admin'
        ) {
            // Créer une session manuellement
            $request->session()->put('admin_logged_in', true);
            return redirect('/admin');
        }

        // Sinon, utiliser le vrai système Laravel
        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        if (! Auth::user()->hasVerifiedEmail()) {
            Auth::logout();
            return redirect()->route('verification.notice')->withErrors([
                'email' => 'Vous devez vérifier votre adresse email avant de vous connecter.',
            ]);
        }

        return redirect('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Vous êtes déconnecté avec succès.');
    }
}
