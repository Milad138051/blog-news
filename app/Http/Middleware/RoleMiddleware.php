<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role, $permission = null)
    {
        if (!$request->user()->hasRole($role) && !$request->user()->hasPermission($permission) && !$request->user()->hasRole('super-admin')) {
          //dd('1');
		  abort(403);
        }

        if (!$request->user()->hasRole($role) && $permission == null && !$request->user()->hasRole('super-admin')) {
            //dd('2');

            abort(403);
        }

        if ($permission !== null && !$request->user()->hasPermission($permission) && !$request->user()->hasRole($role) && !$request->user()->hasRole('super-admin')) {
           // dd('3');

            abort(403);
        }

        return $next($request);
    }
}
