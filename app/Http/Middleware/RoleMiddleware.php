<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if (!$request->user() || !in_array($request->user()->role, $roles)) {
            abort(403, 'You do not have permission to access this page.');
        }

        // Block unapproved trainers
        if ($request->user()->role === 'trainer' && !$request->user()->is_approved) {
            auth()->logout();
            return redirect()->route('login')
                ->with('error', 'Your trainer account is pending approval.');
        }

        return $next($request);
    }
}
