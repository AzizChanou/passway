<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!in_array(auth()->user()->role, ['root', 'admin'])) {
            return redirect()->back()->with('error', 'Vous n\'etes pas autorisé(e) à effectuer cette opération');
        }
        return $next($request);
    }
}
