<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('admin_logged_in')) {
            return $next($request);
        }

        if (Auth::check() && Auth::user()->email === 'admin@admin.com') {
            return $next($request);
        }

        return redirect('/login');
    }
}