<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            // User belum login, redirect ke login page atau kembalikan 401
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            // Role tidak sesuai, kembalikan 403 Forbidden
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
