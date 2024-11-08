<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

        // dd([
        //     'is_authenticated' => Auth::check(),
        //     'user_role' => Auth::user()?->role,
        //     'required_role' => $role
        // ]);

        // if (!Auth::check() || Auth::user()->role !== $role) {
        //     abort(403, 'Unauthorized');
        // }

        if (!Auth::check()) {
            abort(403, 'Please login first');
        }
    
        // Jika role yang diizinkan lebih dari satu
        $allowedRoles = explode('|', $role);
        if (!in_array(Auth::user()->role, $allowedRoles)) {
            abort(403, 'Unauthorized role');
        }

        return $next($request);
    }

}
